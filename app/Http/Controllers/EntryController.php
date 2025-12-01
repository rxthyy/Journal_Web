<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\EntryTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EntryController extends Controller
{
    public function create(Request $request)
    {
        $date = $request->query('date', date('Y-m-d'));
        return view('entry-create', compact('date'));
    }

    public function store(Request $request)
    {
        try {
            // Log incoming request for debugging
            Log::info('Entry store request:', $request->all());

            // Validate the input
            $validated = $request->validate([
                'entry_date' => 'required|date',
                'title' => 'required|string|max:100',
                'content' => 'required|string',
                'privacy' => 'required|in:public,friends,private',
                'mood' => 'nullable|string',
                'allow_comments' => 'nullable|boolean',
                'tags' => 'nullable|array',
                'tags.*' => 'string|max:50'
            ]);

            // Create entry
            $entry = Entry::create([
                'user_id' => Auth::id(),
                'entry_date' => $validated['entry_date'],
                'title' => $validated['title'],
                'content' => $validated['content'],
                'privacy' => $validated['privacy'],
                'mood' => $validated['mood'] ?? null,
                'allow_comments' => $request->has('allow_comments') ? true : false,
            ]);

            Log::info('Entry created:', ['entry_id' => $entry->id]);

            // Add tags if provided
            if (!empty($validated['tags'])) {
                foreach ($validated['tags'] as $tag) {
                    EntryTag::create([
                        'entry_id' => $entry->id,
                        'tag' => strtolower(trim($tag))
                    ]);
                }
            }

            return redirect()->route('calendar')
                ->with('success', 'Entry created successfully!');

        } catch (\Exception $e) {
            Log::error('Error creating entry:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create entry: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $entry = Entry::with('tags')->findOrFail($id);
        
        // Check if user can view this entry
        if ($entry->user_id !== Auth::id() && $entry->privacy === 'private') {
            abort(403, 'Unauthorized');
        }
        
        return view('entry-view', compact('entry'));
    }

    public function getEntriesByMonth(Request $request)
    {
        $year = $request->query('year', date('Y'));
        $month = $request->query('month', date('m'));

        $entries = Entry::where('user_id', Auth::id())
            ->whereYear('entry_date', $year)
            ->whereMonth('entry_date', $month)
            ->with('tags')
            ->get()
            ->groupBy(function($entry) {
                return $entry->entry_date->format('Y-m-d');
            });

        return response()->json($entries);
    }

    public function getByDate($date)
{
    $entries = Entry::where('user_id', Auth::id())
        ->whereDate('entry_date', $date)
        ->with('tags')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($entry) {
            return [
                'id' => $entry->id,
                'title' => $entry->title,
                'content' => $entry->content,
                'privacy' => $entry->privacy,
                'mood' => $entry->mood,
                'created_at' => $entry->created_at->format('g:i A'),
                'tags' => $entry->tags->pluck('tag')
            ];
        });

    return response()->json($entries);
}

    
}