@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="product-detail">

    <div class="product-detail__breadcrumb">
        <a href="/products" class="breadcrumb__link">商品一覧</a>
        <span class="breadcrumb__separator">＞</span>
        <span class="breadcrumb__current">{{ $product->name }}</span>
    </div>

    <form action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data" class="product-form">
        @csrf
        <input id="image" type="file" name="image" class="form-group__file">
        <div class="product-detail__inner">
            <div class="product-detail__left">
                @if ($product->image)
                    <div class="product-detail__image-wrap">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-detail__image">
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-group__label">
                        商品画像
                    </label>
                    <label for="image" class="file-button">ファイルを選択</label>
                </div>
                @if ($errors->has('image'))
                    @foreach ($errors->get('image') as $error)
                        <p class="form-group__error">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
            <div class="product-detail__right">
                <div class="form-group">
                    <label class="form-group__label">
                        商品名
                    </label>
                    <input  type="text" name="name" value="{{ old('name', $product->name) }}" class="form-group__input" placeholder="商品名を入力">
                    @error('name')
                        <p class="form-group__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-group__label">
                        値段
                    </label>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-group__input" placeholder="値段を入力">
                    @error('price')
                        <p class="form-group__error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-group__label">
                        季節
                    </label>
                    @php
                        $oldSeasons = old('seasons', $selectedSeasons ?? []);
                    @endphp
                    <div class="form-group__radio-wrap">
                        <label class="radio-item">
                            <input type="checkbox" name="seasons[]" value="1" {{ in_array('1', $oldSeasons, true) ? 'checked' : '' }}>
                            春
                        </label>
                        <label class="radio-item">
                            <input type="checkbox" name="seasons[]" value="2" {{ in_array('2', $oldSeasons, true) ? 'checked' : '' }}>
                            夏
                        </label>
                        <label class="radio-item">
                            <input type="checkbox" name="seasons[]" value="3" {{ in_array('3', $oldSeasons, true) ? 'checked' : '' }}>
                            秋
                        </label>
                        <label class="radio-item">
                            <input type="checkbox" name="seasons[]" value="4" {{ in_array('4', $oldSeasons, true) ? 'checked' : '' }}>
                            冬
                        </label>
                    </div>
                    @error('seasons')
                        <p class="form-group__error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="product-detail__description">
            <label class="form-group__label product-detail__description-label">
                商品説明
            </label>
            <textarea name="description" class="form-group__textarea product-detail__description-textarea" placeholder="商品説明を入力してください">
                {{ old('description', $product->description) }}
            </textarea>
            @error('description')
                <p class="form-group__error">{{ $message }}</p>
            @enderror
        </div>
        <div class="product-detail__buttons">
            <a href="/products" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">変更を保存</button>
        </div>
    </form>
    <form action="/products/{{ $product->id }}/delete" method="post" class="product-delete-form">
        @csrf
        <button type="submit" class="btn-delete">🗑</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('image');
        const imageWrap = document.querySelector('.product-detail__image-wrap');

        if (!fileInput || !imageWrap) return;

        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file || !file.type.startsWith('image/')) {
                return;
            }

            imageWrap.innerHTML = '';

            const img = document.createElement('img');
            img.classList.add('product-detail__image');
            img.src = URL.createObjectURL(file);

            imageWrap.appendChild(img);
        });
    });
</script>
@endsection
