<?php

namespace musicapprentice;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    public function exercices()
    {
        return $this->hasMany('App\Exercice');
    }
}
