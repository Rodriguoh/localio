<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->company,
                "description" => $this->faker->text,
                "codeComment" => $this->faker->regexify('[A-Za-z0-9]{10}'),
                "number" => $this->faker->buildingNumber,
                "street" => $this->faker->streetName,
                "phone" => $this->faker->phoneNumber,
                "mail" => $this->faker->freeEmail,
                "siret" => $this->faker->siret,
                "url" => $this->faker->url,
                "lat" => $this->faker->latitude(48.330991, 44.158475),
                "lng" => $this->faker->longitude(-0.442661, 5.139075),
                "delivery" => $this->faker->boolean,
                "conditionDelivery" => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
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
        ];
    }
}
