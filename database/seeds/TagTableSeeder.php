<?php

use Illuminate\Database\Seeder;
use musicapprentice\Exercice;
use musicapprentice\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	$myExercice = Exercice::where('name', 'MyFirstExercice')->first();
        $tag = new Tag(); 

    	$tag->name = "My tag";
    	$tag->description = "A little description";
    	$tag->save();
    	$tag->exercices()->attach($myExercice);
    }
}
