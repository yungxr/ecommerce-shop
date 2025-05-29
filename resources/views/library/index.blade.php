@extends('layouts.app')

@section('content')
<div class="library-container">
    <h1>Моя библиотека</h1>
    
    @if($games->isEmpty())
        <div class="library-empty">
            <p>Ваша библиотека пуста</p>
            <a href="{{ route('shop.index') }}" class="btn-shop">В магазин</a>
        </div>
    @else
        <div class="games-grid">
            @foreach($games as $game)
            <div class="game-card">
                <a href="{{ route('library.show', $game) }}">
                    <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}">
                    <div class="game-info">
                        <h3>{{ $game->title }}</h3>
                        <span class="game-genre">{{ $game->genre }}</span>
                    </div>
                </a>
                <button class="btn-play">Играть</button>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection