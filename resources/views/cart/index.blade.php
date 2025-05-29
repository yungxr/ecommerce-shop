@extends('layouts.app')

@section('content')
<div class="cart-container">
    <h1>Ваша корзина</h1>
    
    @if($cartItems->isEmpty())
        <div class="cart-empty">
            <p>Ваша корзина пуста</p>
            <a href="{{ route('shop.index') }}" class="btn-continue">Продолжить покупки</a>
        </div>
    @else
        <div class="cart-items">
            @foreach($cartItems as $item)
            <div class="cart-item">
                <img src="{{ asset('images/games/' . $item->game->image) }}" alt="{{ $item->game->title }}">
                <div class="cart-item-info">
                    <h3>{{ $item->game->title }}</h3>
                    <span class="game-price">{{ number_format($item->game->price, 2, '.', ' ') }} руб.</span>
                </div>
                <form action="{{ route('cart.remove', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-remove">Удалить</button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <div class="total">
                <span>Итого:</span>
                <span class="total-price">{{ number_format($total, 2, '.', ' ') }} руб.</span>
            </div>
            <form action="{{ route('order.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-checkout">Оформить заказ</button>
            </form>
        </div>
    @endif
</div>
@endsection