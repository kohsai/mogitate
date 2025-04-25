@extends('layouts.app')

@section('content')
<div class="main">
    {{-- パンくず --}}
    <div class="breadcrumb-wrapper">
        <a href="{{ route('products.index') }}" class="breadcrumb-link">商品一覧</a> ＞ {{ $product->name }}
    </div>

    {{-- 更新フォーム --}}
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form-wrapper update-form">
        @csrf
        @method('PUT')

        <div class="form-columns">
            {{-- 画像 --}}
            <div class="form-image">
                <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像">
                <input type="file" name="image">
                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- 入力フィールド --}}
            <div class="form-fields">
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}">
                    @error('name') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>値段</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}">
                    @error('price') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>季節</label>
                    @php
                        $allSeasons = App\Models\Season::all();
                        $selectedSeasons = old('seasons', $product->seasons->pluck('id')->toArray());
                    @endphp
                    <div class="checkbox-group">
                        @foreach ($allSeasons as $season)
                            <label>
                                <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, $selectedSeasons) ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('seasons') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        {{-- 商品説明 --}}
        <div class="form-group">
            <label>商品説明</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
            @error('description') <div class="error-message">{{ $message }}</div> @enderror
        </div>

        {{-- ボタンエリア --}}
        <div class="form-action-row">
            <div class="form-buttons">
                <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
                <button type="submit" class="btn-submit">変更を保存</button>
            </div>
        </div>
    </form>

    {{-- 削除ボタン --}}
    <div class="delete-button-wrapper">
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button" title="削除">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    </div>
</div>
@endsection
