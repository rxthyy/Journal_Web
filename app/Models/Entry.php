<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entry_date',
        'title',
        'content',
        'privacy',
        'mood',
        'allow_comments'
    ];

    protected $casts = [
        'entry_date' => 'date',
        'allow_comments' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->hasMany(EntryTag::class);
    }
}