@extends('layouts.app')

@section('content')
    <div class="product-index">
        <h2 class="index-title">商品一覧</h2>

        @if ($products->isEmpty())
            <p>現在、登録されている商品はありません。</p>
        @else
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

            {{-- ページネーション --}}
            <div class="pagination-wrapper">
                {{ $products->links('vendor.pagination.custom') }}
            </div>

        @endif
    </div>
@endsection
