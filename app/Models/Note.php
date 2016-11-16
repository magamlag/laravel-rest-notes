<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

	protected $fillable = [	'text', 'user_id' ];

	public function tags() {
		return $this->belongsToMany( Tag::class, 'notes_tags', 'note_id', 'tag_id' );
	}
}
