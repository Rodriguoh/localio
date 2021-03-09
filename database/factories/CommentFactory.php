<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "note" => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5),
            "comment" => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            "date" => now(),
            "store_id" => \App\Models\Store::all()->random(1)[0]->id,
            "user_id" => \App\Models\User::all()->where('role_id','1')->random(1)[0]->id
        ];
    }
}
