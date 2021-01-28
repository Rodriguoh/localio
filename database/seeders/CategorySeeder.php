<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "restaurant" => [
                "pizzeria",
                "gastronomique",
                "kebab",
            ],
            "bar" => [],
            "alimentaire" => [
                "maraicher",
                "eleveur bovin",
            ]
        ];

        foreach ($categories as $category => $underCategories) {
            $catId = \DB::table('categories')->insertGetId(["label" => $category]);

            foreach ($underCategories as $underCategory) {
                \DB::table('categories')->insert(
                    [
                        "label" => $underCategory,
                        "category_id" => $catId,
                    ]
                );
            }
        }
    }
}
