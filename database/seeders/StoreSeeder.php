<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct()
    {
        
    }
    public function run()
    {
       
        \App\Models\Store::factory(10)->create();
      
        /*
         $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('codeComment', 10)->nullable();
            $table->string('number', 15);
            $table->string('street', 45);
            $table->string('phone', 20);
            $table->string('mail', 80);
            $table->string('SIRET', 14);
            $table->string('url')->nullable();
            $table->decimal('lat', 8, 5)->nullable();
            $table->decimal('lng', 8, 5)->nullable();
            $table->string('delivery', 1)->nullable();
            $table->string('conditionDelivery')->nullable();
            $table->text('openingHours')->nullable();

            $table->foreignId('user_id')->constrained();

            $table->foreignId('state_id')->nullable()->constrained();

            $table->foreignId('city_INSEE')->references('INSEE')->on('cities');

            $table->foreignId('category_id')->constrained();
        */
    }
}
