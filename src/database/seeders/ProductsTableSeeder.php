<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        //商品データ
        $products = [
            [
                'name' => 'キウイ',
                'price' => 800,
                'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/kiwi.png',
            ],
            [
                'name' => 'ストロベリー',
                'price' => 1200,
                'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/strawberry.png',
            ],
            [
                'name' => 'オレンジ',
                'price' => 850,
                'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。酸味は控えめで、甘さと濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/orange.png',
            ],
            [
                'name' => 'スイカ',
                'price' => 700,
                'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の90％が水分のため、暑い日の水分補給や熱中症予防、カロリーが気になる方にもおすすめの商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/watermelon.png',
            ],
            [
                'name' => 'ピーチ',
                'price' => 1000,
                'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。美味しさはもちろん見た目の可愛さも抜群の商品です。ビタミンEが豊富なため、生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/peach.png',
            ],
            [
                'name' => 'シャインマスカット',
                'price' => 1400,
                'description' => '爽やかな香りと上品な甘みが特長的なシャインマスカットは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/muscat.png',
            ],
            [
                'name' => 'パイナップル',
                'price' => 800,
                'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。当店では甘さと酸味のバランスが絶妙な国産のパイナップルを使用しています。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/pineapple.png',
            ],
            [
                'name' => 'ブドウ',
                'price' => 1100,
                'description' => 'ブドウの中でも人気の高い国産の「巨峰」を使用しています。高い糖度と適度な酸味が魅力で、鮮やかなパープルで見た目も可愛い商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/grapes.png',
            ],
            [
                'name' => 'バナナ',
                'price' => 600,
                'description' => '低カロリーでありながら栄養満点のため、ダイエット中の方にもおすすめの商品です。1杯でバナナの濃厚な甘みを存分に堪能できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/banana.png',
            ],
            [
                'name' => 'メロン',
                'price' => 900,
                'description' => '香りがよくジューシーで品のある甘さが人気のメロンスムージー。カリウムが多く含まれているためむくみ解消効果も抜群です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'images/melon.png',
            ],
        ];

        foreach($products as $product) {
            Product::create($product);
        }

        // 商品と季節のリレーション付け
        $kiwi = Product::where('name', 'キウイ')->first();
        if ($kiwi) {
            $kiwi->seasons()->attach([3, 4]); // 秋・冬
        }

        $strawberry = Product::where('name', 'ストロベリー')->first();
        if ($strawberry) {
             $strawberry->seasons()->attach([1]); // 春
        }

        $orange = Product::where('name', 'オレンジ')->first();
        if ($orange) {
            $orange->seasons()->attach([4]); // 冬
        }

        $watermelon =  Product::where('name', 'スイカ')->first();
        if ($watermelon) {
            $watermelon->seasons()->attach([2]); // 夏
        }

        $peach =  Product::where('name', 'ピーチ')->first();
        if ($peach) {
            $peach->seasons()->attach([2]); // 夏
        }

        $muscat =  Product::where('name', 'シャインマスカット')->first();
        if ($muscat) {
            $muscat->seasons()->attach([2, 3]); // 夏・秋
        }

        $pineapple =  Product::where('name', 'パイナップル')->first();
        if ($pineapple) {
             $pineapple->seasons()->attach([1, 2]); // 春・夏
        }

        $grapes =  Product::where('name', 'ブドウ')->first();
        if ($grapes) {
            $grapes->seasons()->attach([2, 3]); // 夏・秋
        }

        $banana =  Product::where('name', 'バナナ')->first();
        if ($banana) {
            $banana->seasons()->attach([2]); // 夏
        }

        $melon =  Product::where('name', 'メロン')->first();
        if ($melon) {
            $melon->seasons()->attach([1, 2]); // 春・夏
        }
    }

}

