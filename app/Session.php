<?php

namespace musicapprentice;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

	protected $fillable= ['name', 'description'];

	public function exercices() {
		return $this->belongsToMany('musicapprentice\Exercice')->withPivot('tempo', 'seconds');
	}

	public function user()
    {
        return $this->belongsTo('musicapprentice\User');
    }
}


