<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(StoreSeeder::class);
       


    }
}
