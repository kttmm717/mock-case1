<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryItem;

class CategoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [1,5,9];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 1,
                'category_id' => $category
            ]);
        }
        $categories = [1,4];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 2,
                'category_id' => $category
            ]);
        }
        $categories = [1,12];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 3,
                'category_id' => $category
            ]);
        }
        $categories = [2,3];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 4,
                'category_id' => $category
            ]);
        }
        $categories = [1,5,12];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 5,
                'category_id' => $category
            ]);
        }
        $categories = [1,4,12];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 6,
                'category_id' => $category
            ]);
        }
        $categories = [4,6];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 7,
                'category_id' => $category
            ]);
        }
        $categories = [5,8];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 8,
                'category_id' => $category
            ]);
        }
        $categories = [6,7,8];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 9,
                'category_id' => $category
            ]);
        }
        $categories = [9,13];
        foreach($categories as $category) {
            CategoryItem::create([
                'item_id' => 10,
                'category_id' => $category
            ]);
        }
    }
}
