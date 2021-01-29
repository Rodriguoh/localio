<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creer 10 utilisateurs
        \App\Models\User::factory(10)->create();


        //Création d'un compte administrateur
        DB::table('users')->insert(
            [
                "email" => "ladministrateur@gmail.com",
                "password" => Hash::make('password'),
                "lastname" => "Sophie",
                "firstname" => "Administratorus",
                "phone" => "0620987635",
                "role_id" => \App\Models\Role::where('name', 'admin')->first()->id
            ]
        );

        //Création d'un compte modérateur
        DB::table('users')->insert(
            [
                "email" => "lemoderateur@gmail.com",
                "password" => Hash::make('password'),
                "lastname" => "Antoine",
                "firstname" => "Moderatorus",
                "phone" => "0620321283",
                "role_id" => \App\Models\Role::where('name', 'moderator')->first()->id
            ]
        );

        //Création d'un compte owner
        DB::table('users')->insert(
            [
                "email" => "lowner@gmail.com",
                "password" => Hash::make('password'),
                "lastname" => "Thomas",
                "firstname" => "Ownorus",
                "phone" => "0787653421",
                "role_id" => \App\Models\Role::where('name', 'owner')->first()->id
            ]
        );

        //Création d'un compte utilisateur
        DB::table('users')->insert(
            [
                "email" => "lutilisateur@gmail.com",
                "password" => Hash::make('password'),
                "lastname" => "Karim",
                "firstname" => "utilisatorus",
                "phone" => "0782659421",
                "role_id" => \App\Models\Role::where('name', 'user')->first()->id
            ]
        );
    }
}
