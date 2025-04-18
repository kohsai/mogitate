<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Season;

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
        $seasons = Season::all();

        return view('products.create', compact('seasons'));
    }


    public function show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        return view('products.show', compact('product'));
    }


    public function index(Request $request)
    {
    $query = Product::with('seasons');

    // 商品名で部分一致検索
    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    // 並び替え（sort パラメータ）
    if ($request->filled('sort')) {
        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }
    } else {
        // デフォルト：新しい順
        $query->orderBy('id', 'desc');
    }

    $products = $query->paginate(6)->appends($request->only(['keyword', 'sort']));

    return view('products.index', compact('products'));
    }

    public function update(UpdateProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $validated = $request->validated();

        // 画像の保存処理（ある場合のみ）
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        // Product情報のみ更新（seasonsを除く）
        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $validated['image'] ?? $product->image,
        ]);

        // リレーションの同期（中間テーブルを更新）
        $product->seasons()->sync($validated['seasons']);


        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }


}