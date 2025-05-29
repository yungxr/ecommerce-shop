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
                    <h3>{{ $game->title }}</h3>
                    <span class="game-price">{{ number_format($game->price, 2, '.', ' ') }} руб.</span>
                    <span class="game-genre">{{ $game->genre }}</span>
                </div>
            </a>
            <form action="{{ route('cart.add', $game) }}" method="POST">
                @csrf
                <button type="submit" class="btn-buy">В корзину</button>
            </form>
        </div>
        @endforeach
    </div>

    {{ $games->links() }}
</div>
@endsection