<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker;

//$faker = Faker\Factory::create('fr_FR');
$faker = Faker\Factory::create('fr_FR');
class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct($faker)
    {
        $this->faker = $faker;
    }
    public function run($faker)
    {
       
        \App\Models\Store::factory(10)->create();
        \DB::table('stores')->insert(
            [
                "name" => $faker->company,
                "description" => $faker->text,
                "codeComment" => $faker->regexify('[A-Za-z0-9]{10}'),
                "number" => $faker->buildingNumber,
                "street" => $faker->streetName,
                "phone" => $faker->phoneNumber,
                "mail" => $faker->freeEmail,
                "siret" => $faker->siret,
                "url" => $faker->url,
                "lat" => $faker->latitude(48.330991, 44.158475),
                "lng" => $faker->longitude(-0.442661, 5.139075),
                "delivery" => $faker->boolean,
                "conditionDelivery" => $faker->sentence($nbWords = 5, $variableNbWords = true),
                "openingHours" => '{
                    "Monday" : [08:30, 16:30]
                    "Tuesday" : [08:30, 16:30]
                    "Wednesday" : [08:30, 12:30]
                    "Thursday" : [08:30, 16:30]
                    "Friday" :  [08:30, 16:30]
                    "Saturday" : [08:30, 16:30]
                    "Sunday" :  [08:30, 12:30]
                }',
                "user_id" => \App\Models\User::all()->where('role_id','2')->random(1)[0]->id,
                "city_INSEE" => \App\Models\City::all()->random(1)[0]->INSEE,
                "category_id" => \App\Models\Category::all()->random(1)[0]->id
            ]
        );
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
