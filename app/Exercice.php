<?php

namespace musicapprentice;

use Illuminate\Database\Eloquent\Model;
use musicapprentice\Session;

class Exercice extends Model
{

	protected $fillable= ['name', 'description','text', 'categoria_id'];


    protected $attributes = [
        'name' => '',
        'description' => '',
        'text' => '',
        'categoria_id' => 0,

    ];
    public function sessions() {
		return $this->belongsToMany('musicapprentice\Session')->withPivot('tempo', 'seconds');
	}

	public function tags() {
		return $this->belongsToMany('musicapprentice\Tag');
	}

	public function category()
    {
        return $this->belongsTo('musicapprentice\Category', 'categoria_id');
    }

    public function user()
    {
        return $this->belongsTo('musicapprentice\User');
    }


    public static function ContainsSession(Exercice $exercice, Session $checkSession){

        foreach ($exercice->sessions as $session){
            if ($session->id == $checkSession->id){
                return true; 
            }
        }
        return false; 
    }
}