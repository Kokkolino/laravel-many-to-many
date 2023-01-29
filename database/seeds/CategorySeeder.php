<?php

use Illuminate\Database\Seeder;
use App\Category;
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
            'Antipasto',
            'Primo',
            'Secondo',
            'Contorno',
            'Dolce',
        ];

        foreach($categories as $category){

            $new_category = new Category;
            $new_category->category = $category;
            $new_category->save();

        }

    }
}
