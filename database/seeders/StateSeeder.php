<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        //1: en attente de validation (pending)
        \DB::table('states')->insert(
            [
                "label" => "pending",
                "description" => "en attente de validation"
            ]
        );
        //2: valide (approved)
        \DB::table('states')->insert(
            [
                "label" => "approved",
                "description" => "a été approuvé"
            ]
        );
        //3: refuser (refused)
        \DB::table('states')->insert(
            [
                "label" => "refused",
                "description" => "a été refusé"
            ]
        );
    }
}
