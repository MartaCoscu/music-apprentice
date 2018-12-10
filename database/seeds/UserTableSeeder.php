<?php

use Illuminate\Database\Seeder;
use musicapprentice\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User(); 
        $user->name = "Marta";
     	$user->email = "mail@mail.com";
     	$user->password =  bcrypt('query');
     	$user->save(); 
    }
}
