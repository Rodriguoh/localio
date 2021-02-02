<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Paris 11ème Arrondissement
        \DB::table('cities')->insert(
            [
                'INSEE' => '75111',
                'name' => 'Paris 11e Arrondissement',
                'ZIPcode' => '75011',
                'lat' => 48.8580105,
                'lng' => 2.3811584,     
            ]
        );

        //Montpellier
        \DB::table('cities')->insert(
            [
                'INSEE' => '34172',
                'name' => 'Montpellier',
                'ZIPcode' => '34000',
                'lat' => 43.6109200,
                'lng' => 3.8772300,     
            ]
        );
    }
}
