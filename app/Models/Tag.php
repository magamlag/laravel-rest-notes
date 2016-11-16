<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['name'];

    public function notes()
    {
        return $this->belongsToMany(
            Note::class,'notes_tags','tag_id','note_id'
        );
    }
}
