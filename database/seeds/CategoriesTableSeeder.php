<?php

use Illuminate\Database\Seeder;
use musicapprentice\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c1 = new Category(); 
        $c1->name = "Entrenamiento auditivo";
        $c1->description = "Entrenamiento auditivo";
        $c1->save(); 

        $c2 = new Category(); 
        $c2->name = "Teoria musical";
        $c2->description = "Teoria musical";
        $c2->save(); 

        $c3 = new Category(); 
        $c3->name = "Técnica";
        $c3->description = "Técnica";
        $c3->save(); 

        $c4 = new Category(); 
        $c4->name = "Repertorio";
        $c4->description = "Repertorio";
        $c4->save(); 

        $c5 = new Category(); 
        $c5->name = "Composición";
        $c5->description = "Composición";
        $c5->save(); 

    }
}
