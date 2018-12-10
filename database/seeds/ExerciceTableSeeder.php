<?php

use Illuminate\Database\Seeder;
use musicapprentice\Exercice;
use musicapprentice\User;


class ExerciceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercice = new Exercice(); 
    	$user = User::all()->first(); 

		$exercice->name = "MyFirstExercice";
        $exercice->description = "A simple description";
        $exercice->image = "An image url";
        $exercice->video = "A video url";
        $exercice->audio = "An audio url";
        $exercice->text = "A long text";
        $exercice->categoria_id = 0;
        $exercice->user_id = 0;
    //	$user->exercices()->attach($exercice);
        $exercice->save(); 
    }
}
