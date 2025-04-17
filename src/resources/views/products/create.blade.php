@extends('layouts.app')

@section('content')
    <div class="form-wrapper">
        <h2 class="form-title">商品登録</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- 商品名 --}}
            <div class="form-group">
                <label for="name">商品名 <span class="required">必須</span></label>
                <input type="text" name="name" id="name" placeholder="商品名を入力" value="{{ old('name') }}">
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- 値段 --}}
            <div class="form-group">
                <label for="price">値段 <span class="required">必須</span></label>
                <input type="number" name="price" id="price" placeholder="値段を入力" value="{{ old('price') }}">
                @error('price')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- 商品画像 --}}
            <div class="form-group">
                <label for="image">商品画像 <span class="required">必須</span></label>

                {{-- プレビュー画像を追加 --}}
            <div id="image-preview-wrapper" style="margin-top: 12px;">
                <img id="image-preview" src="#" alt="プレビュー画像" style="display: none; max-width: 300px;">
            </div>

            {{-- ボタン＋ファイル名表示 --}}
            <div style="display: flex; align-items: center; gap: 12px;">
                <label class="file-label">
                    ファイルを選択
                    <input type="file" name="image" id="image" class="file-input">
                </label>
                <p id="file-name" style="font-size: 14px; color: #666; margin-top: 8px;"></p>
            </div>

                @error('image')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- 季節 --}}
            <div class="form-group">
                <label>季節 <span class="required">必須</span> <span class="note">複数選択可</span></label>
                <div class="checkbox-group">
                    @foreach($seasons as $season)
                        <label>
                            <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                                {{ (is_array(old('seasons')) && in_array($season->id, old('seasons'))) ? 'checked' : '' }}>
                            {{ $season->name }}
                        </label>
                    @endforeach
                </div>
                @error('seasons')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- 商品説明 --}}
            <div class="form-group">
                <label for="description">商品説明 <span class="required">必須</span></label>
                <textarea name="description" id="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- ボタン --}}
            <div class="form-buttons">
                <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
                <button type="submit" class="btn-submit">登録</button>
            </div>
        </form>
    </div>

<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');
        const fileNameText = document.getElementById('file-name');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);

            fileNameText.textContent = file.name; // ← ファイル名表示
        } else {
            preview.src = '#';
            preview.style.display = 'none';
            fileNameText.textContent = ''; // ← ファイル名リセット
        }
    });
</script>

@endsection