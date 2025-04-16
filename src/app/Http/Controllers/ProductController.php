<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request)
    {
    // アップロードされた画像を保存
    $imagePath = $request->file('image')->store('images', 'public');

    // 商品を保存
    $product = Product::create([
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'description' => $request->input('description'),
        'image' => $imagePath,
    ]);

    // seasons を紐づける（中間テーブル）
    $product->seasons()->attach($request->input('seasons'));

    // 一覧ページへリダイレクト
    return redirect()->route('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function show($productId)
    {
        return "詳細ページ(productId:{$productId}) ";
    }
}