@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="product-page">
    <div class="product-page__header">
        <h2 class="product-page__title">
            @if(!empty($keyword))
                “{{ $keyword }}”の商品一覧
            @else
                商品一覧
            @endif
        </h2>
        <a href="/products/register" class="product-add-button">
            ＋ 商品を追加
        </a>
    </div>
    <div class="product-page__body">
        <aside class="product-search-panel">
            <form action="/products/search" method="get" class="product-search-form">
                <div class="product-search-form__group">
                    <input type="text" name="keyword" class="product-search-form__input" placeholder="商品名で検索" value="{{ $keyword }}">
                </div>
                <div class="product-search-form__group">
                    <button type="submit" class="product-search-form__submit">
                        検索
                    </button>
                </div>
                <div class="product-search-form__group product-sort">
                    <p class="product-sort__label">価格順で表示</p>
                    <select name="sort" class="product-sort__select">
                        <option value="">価格で並べ替え</option>
                        <option value="high" {{ $sort === 'high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low"  {{ $sort === 'low'  ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                    @if($sort === 'high' || $sort === 'low')
                        <div class="product-sort__badge">
                            <span class="product-sort__badge-text">
                                {{ $sort === 'high' ? '高い順に表示' : '低い順に表示' }}
                            </span>
                            @php
                                $resetUrl = '/products';
                                if (!empty($keyword)) {
                                    $resetUrl = '/products/search?keyword=' . urlencode($keyword);
                                }
                            @endphp
                            <a href="{{ $resetUrl }}" class="product-sort__badge-close">×</a>
                        </div>
                    @endif
                </div>
            </form>
        </aside>
        <section class="product-list">
            @if($products->isEmpty())
                <p class="product-list__empty">該当する商品がありません。</p>
            @else
                <div class="product-grid">
                    @foreach ($products as $product)
                        <a href="/products/detail/{{ $product->id }}" class="product-card">
                            <div class="product-card__image-wrap">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-card__image">
                            </div>
                            <div class="product-card__body">
                                <p class="product-card__name">{{ $product->name }}</p>
                                <p class="product-card__price">¥{{ number_format($product->price) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="product-pagination">
                    {{ $products->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
