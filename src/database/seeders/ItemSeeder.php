<?php

namespace Database\Seeders;

use App\Models\Condition;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => '腕時計',
                'price' => 15000,
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'img_url' => 'public/img/Clock.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$UNUSED,
            ],
            [
                'name' => 'HDD',
                'price' => 5000,
                'description' => '高速で信頼性の高いハードディスク',
                'img_url' => 'public/img/HDD.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$UNUSED,
            ],
            [
                'name' => '玉ねぎ3束',
                'price' => 300,
                'description' => '新鮮な玉ねぎ3束のセット',
                'img_url' => 'public/img/onion.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$UNUSED,
            ],
            [
                'name' => '革靴',
                'price' => 4000,
                'description' => 'クラシックなデザインの革靴',
                'img_url' => 'public/img/Shoes.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$HARMLESS,
            ],
            [
                'name' => 'ノートPC',
                'price' => 45000,
                'description' => '高性能なノートパソコン',
                'img_url' => 'public/img/PC.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$HARMLESS,
            ],
            [
                'name' => 'マイク',
                'price' => 8000,
                'description' => '高音質のレコーディング用マイク',
                'img_url' => 'public/img/Mic.jpg',
                'user_id' => 2,
                'condition_id' => Condition::$HARMED,
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'description' => 'おしゃれなショルダーバッグ',
                'img_url' => 'public/img/bag.jpg',
                'user_id' => 1,
                'condition_id' => Condition::$HARMED,
            ],
            [
                'name' => 'タンブラー',
                'price' => 500,
                'description' => '使いやすいタンブラー',
                'img_url' => 'public/img/Tumbler.jpg',
                'user_id' => 1,
                'condition_id' => Condition::$UNUSED,
            ],
            [
                'name' => 'コーヒーミル',
                'price' => 4000,
                'description' => '手動のコーヒーミル',
                'img_url' => 'public/img/Coffee.jpg',
                'user_id' => 1,
                'condition_id' => Condition::$UNUSED,
            ],
            [
                'name' => 'メイクセット',
                'price' => 2500,
                'description' => '便利なメイクアップセット',
                'img_url' => 'public/img/make.jpg',
                'user_id' => 1,
                'condition_id' => Condition::$UNUSED,
            ],
        ];
        foreach($items as $item) {
            Item::create($item);
        }

        Like::create([
            'user_id' => 1,
            'item_id' => 1
        ]);
        Like::create([
            'user_id' => 2,
            'item_id' => 7
        ]);
    }
}
