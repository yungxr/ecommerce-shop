@extends('layouts.app')

@section('content')
<div class="shop-container">
    <div class="shop-header">
        <h1>Магазин игр</h1>

        <div class="shop-controls">
            <form class="search-form">
                <input type="text" name="search" placeholder="Поиск игр..." value="{{ request('search') }}">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>

            <div class="genre-filter">
                <select onchange="window.location.href = this.value">
                    <option value="{{ route('shop.index') }}">Все жанры</option>
                    @foreach($genres as $genre)
                    <option value="{{ route('shop.index', ['genre' => $genre]) }}"
                        {{ request('genre') == $genre ? 'selected' : '' }}>
                        {{ $genre }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="games-grid">
        @foreach($games as $game)
        <div class="game-card">
            <a href="{{ route('shop.show', $game) }}">
                <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}">
                <div class="game-info">
                    <h3 class="color-txt">{{ $game->title }}</h3>
                    @if($game->hasActiveDiscount())
                    <div class="game-price-with-discount">
                        <span class="original-price">{{ number_format($game->price, 2, '.', ' ') }} руб.</span>
                        <span class="discounted-price">{{ number_format($game->discounted_price, 2, '.', ' ') }} руб.</span>
                    </div>
                                    @if($game->hasActiveDiscount())
                <div class="discount-ribbon">
                    -{{ $game->discounts->where('is_active', true)->where('start_date', '<=', now())->where('end_date', '>=', now())->first()->percent }}%
                </div>
                @endif
                    @else
                    <span class="game-price">{{ number_format($game->price, 2, '.', ' ') }} руб.</span>
                    @endif
                    <span class="game-genre">{{ $game->genre }}</span>

                    <!-- Добавленный блок рейтинга -->
                    @if($game->reviews->count() > 0)
                    <div class="game-rating">
                        <span class="rating-stars">
                            {{ number_format($game->averageRating(), 1) }} ★
                        </span>
                        <span class="rating-count">({{ $game->reviews->count() }})</span>
                    </div>
                    @else
                    <div class="game-rating no-reviews">
                        Нет отзывов
                    </div>
                    @endif
                </div>
            </a>

            <div class="game-actions">
                <form action="{{ route('cart.add', $game) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-buy">В корзину</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .game-price-with-discount {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .original-price {
        text-decoration: line-through;
        color: #999;
        font-size: 0.9em;
    }
    .discounted-price {
        color: #ff4757;
        font-weight: bold;
        font-size: 1.1em;
    }
    .game-price {
        color: #fff;
        font-weight: bold;
    }
</style>
@endsection