<?php

namespace musicapprentice;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	public function exercices() {
		return $this->belongsToMany('musicapprentice\Exercice');
	}
}
