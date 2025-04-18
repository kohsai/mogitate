@extends('layouts.app')

@section('content')
<div class="product-index">
    <div class="add-button-wrapper">
    <a href="{{ route('products.create') }}" class="add-button">＋商品を追加</a>
    </div>

    <div class="product-layout">
        {{-- 左カラム（検索・ソート） --}}
        <div class="search-area">
            <h2 class="index-title">商品一覧</h2>

            {{-- 検索フォーム --}}
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
                <input
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    placeholder="商品名で検索"
                >
                <button type="submit">検索</button>

                {{-- 並び替えフォーム --}}
                <div class="sort-form">
                    <label for="sort">価格順で表示</label>
                    <select name="sort" id="sort" onchange="this.form.submit()">
                        <option value="">価格で並べ替え</option>
                        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>安い順に表示</option>
                    </select>
                </div>
            </form>

            {{-- 選択中の並び替えタグ表示（リセット可能） --}}
            @if (request('sort'))
                <div class="sort-tag">
                    <span>
                        {{ request('sort') === 'high' ? '高い順に表示' : '安い順に表示' }}
                    </span>
                    <a href="{{ route('products.index', array_filter(request()->except('sort'))) }}" class="sort-reset">×</a>
                </div>
            @endif
        </div>

        {{-- 右カラム（商品一覧） --}}
        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像">
                    <div class="product-info">
                        <span class="product-name">{{ $product->name }}</span>
                        <span class="product-price">¥{{ number_format($product->price) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- ページネーション --}}
    <div class="pagination-wrapper">
        {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
