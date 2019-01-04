<?php

namespace musicapprentice;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable= ['name', 'description'];

    public function exercices()
    {
        return $this->hasMany('App\Exercice');
    }
}
