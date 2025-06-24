@extends('layouts.app')

@section('content')
<div class="wishlist-container">
    <h1 class="">Желаемое</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($games->isEmpty())
    <div class="empty-wishlist">
        <p>Ваших желаемыех игр нет</p>
        <a href="{{ route('shop.index') }}" class="btn-shop">Перейти в магазин</a>
    </div>
    @else
    <div class="wishlist-games">
        @foreach($games as $game)
        <div class="wishlist-game">
            <a href="{{ route('shop.show', $game) }}" class="game-link">
                <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}">
                <h3>{{ $game->title }}</h3>
                <span class="price">{{ number_format($game->price, 0, ',', ' ') }} ₽</span>
                <span class="game-genre-wishlist">{{ $game->genre }}</span>
            </a>
            <div class="actions">
                <form action="{{ route('cart.add', $game) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-add-to-cart">В корзину</button>
                </form>
                <form action="{{ route('wishlist.toggle', $game) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-remove">Удалить</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<style>
    .wishlist-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .wishlist-container h1 {
        color: #fff;
    }

    .game-genre-wishlist {
        display: inline-block;
        background: rgba(108, 92, 231, 0.2);
        color: #a29bfe;
        padding: 3px 8px;
        margin: 0px 15px 10px;
        border-radius: 4px;
        font-size: 0.8rem;
    }

    .alert-success {
        background: #2d3436;
        color: #fff;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .wishlist-games {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .wishlist-game {
        background: #2d3436;
        color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .wishlist-game:hover {
        transform: translateY(-5px);
    }

    .game-link {
        text-decoration: none;
        color: inherit;
    }

    .wishlist-game img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .wishlist-game h3 {
        padding: 10px 15px;
        margin: 0;
        font-size: 16px;
        color: #fff;
    }

    .wishlist-game .price {
        display: block;
        padding: 0 15px 10px;
        font-weight: bold;
        color: #6c5ce7;
    }

    .actions {
        display: flex;
        padding: 0 15px 15px;
        gap: 10px;
    }

    .btn-add-to-cart {
        flex: 1;
        background: #6c5ce7;
        color: white;
        border: none;
        padding: 8px;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-add-to-cart:hover {
        background: #6c5ce7;
    }

    .btn-remove {
        background: #e74c3c;
        color: white;
        border: none;
        padding: 8px;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-remove:hover {
        background: #c0392b;
    }

    .empty-wishlist {
        text-align: center;
        padding: 50px 0;
    }

    .empty-wishlist p {
        color: #fff;
        font-size: 18px;
    }

    .btn-shop {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        background: #6c5ce7;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background 0.3s;
    }

    .btn-shop:hover {
        background: #2980b9;
    }
</style>
@endsection