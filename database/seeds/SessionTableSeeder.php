<?php

use Illuminate\Database\Seeder;
use musicapprentice\Session;
use musicapprentice\Exercice;
use musicapprentice\User;

class SessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


    	$myExercice = Exercice::where('name', 'MyFirstExercice')->first();
    	$user = User::all()->first(); 
        $session = new Session(); 

    	$session->name = "My session";
    	$session->description = "A little description";
    	$session->user_id = 0;

    	$session->save();
    	$session->exercices()->attach($myExercice,['tempo' => 120, 'seconds' => 300]);
    //	$user->sessions()->attach($session);
    }
}
