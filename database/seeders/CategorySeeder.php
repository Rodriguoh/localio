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
                "indien",
                "chinois",
                "thailandais",
                "italien",
                "pizzeria",
                "gastronomique",
            ],
            "alimentaire" => [
                "epicerie",
                "marché paysan",
                "boulangerie - pâtisserie",
                "poissonerie",
                "boucherie - charcuterie",
                "fromagerie",
            ],
            "bio" => [
                "epicerie",
                "marché paysan",
                "fromagerie",
                "boucherie - charcuterie",
            ],
            "non alimentaire" => [
                "fleuriste",
                "quincaillerie",
                "tapisserie",
                "bureau de tabac",
                "matériel informatique",
            ],
            "culture" => [
                "librairie",
                "presse",
                "matériel de sport",
                "jeux vidéos",
                "matériel de musique",
            ],
            "habillement" => [
                "vêtements",
                "chaussures",
            ],
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
