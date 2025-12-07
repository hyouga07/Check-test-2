@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="product-create">
    <h2 class="product-create__title">商品登録</h2>

    <form action="/products/register" method="post" enctype="multipart/form-data" class="product-form">
        @csrf
        <div class="form-group">
            <label class="form-group__label">
                商品名
                <span class="form-group__required">必須</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-group__input" placeholder="商品名を入力">
            @error('name')
                <p class="form-group__error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-group__label">
                値段
                <span class="form-group__required">必須</span>
            </label>
            <input type="text" name="price" value="{{ old('price') }}" class="form-group__input" placeholder="値段を入力">
            @if ($errors->has('price'))
                @foreach ($errors->get('price') as $error)
                    <p class="form-group__error">{{ $error }}</p>
                @endforeach
            @endif
        </div>
        <div class="form-group">
            <label class="form-group__label">
                商品画像
                <span class="form-group__required">必須</span>
            </label>
            <div class="form-group__preview-wrap"></div>
            <label for="image" class="file-button">ファイルを選択</label>
            <input id="image" type="file" name="image" class="form-group__file">
            @if ($errors->has('image'))
                @foreach ($errors->get('image') as $error)
                    <p class="form-group__error">{{ $error }}</p>
                @endforeach
            @endif
        </div>
        <div class="form-group">
            <label class="form-group__label">
                季節
                <span class="form-group__required">必須</span>
                <span class="form-group__note">複数選択可</span>
            </label>
            @php
                $oldSeasons = old('seasons', []);
            @endphp
            <div class="form-group__radio-wrap">
                <label class="radio-item">
                    <input type="checkbox" name="seasons[]" value="1"
                        {{ in_array('1', $oldSeasons, true) ? 'checked' : '' }}>
                    春
                </label>
                <label class="radio-item">
                    <input type="checkbox" name="seasons[]" value="2"
                        {{ in_array('2', $oldSeasons, true) ? 'checked' : '' }}>
                    夏
                </label>
                <label class="radio-item">
                    <input type="checkbox" name="seasons[]" value="3"
                        {{ in_array('3', $oldSeasons, true) ? 'checked' : '' }}>
                    秋
                </label>
                <label class="radio-item">
                    <input type="checkbox" name="seasons[]" value="4"
                        {{ in_array('4', $oldSeasons, true) ? 'checked' : '' }}>
                    冬
                </label>
            </div>
            @error('seasons')
                <p class="form-group__error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-group__label">
                商品説明
                <span class="form-group__required">必須</span>
            </label>
            <textarea name="description" class="form-group__textarea" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <p class="form-group__error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-btn-wrap">
            <a href="/products" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">登録</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('image');
        const previewWrap = document.querySelector('.form-group__preview-wrap');

        if (!fileInput || !previewWrap) return;

        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            previewWrap.innerHTML = '';

            if (!file) {
                return;
            }

            if (!file.type.startsWith('image/')) {
                return;
            }

            const img = document.createElement('img');
            img.classList.add('form-group__preview');
            img.src = URL.createObjectURL(file);

            previewWrap.appendChild(img);
        });
    });
</script>
@endsection
