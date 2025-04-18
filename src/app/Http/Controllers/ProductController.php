<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
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

    // 商品検索（仮実装）
    public function show($productId)
    {
        return "詳細ページ(productId:{$productId}) ";
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
}