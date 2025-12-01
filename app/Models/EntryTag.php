<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntryTag extends Model
{
    protected $fillable = ['entry_id', 'tag'];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}