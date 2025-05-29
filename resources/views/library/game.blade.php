@extends('layouts.app')

@section('content')
<div class="library-game-container">
    <div class="game-header">
        <h1>{{ $game->title }}</h1>
        <p class="purchase-date">Приобретено: {{ $purchased_at->format('d.m.Y H:i') }}</p>
    </div>

    <div class="game-content">
        <div class="game-media">
            <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}" class="main-image">
            
            @if($game->screenshots && is_array($game->screenshots))
            <div class="screenshots-grid">
                @foreach($game->screenshots as $screenshot)
                <img src="{{ asset('images/games/screenshots/' . $screenshot) }}" alt="Скриншот" class="screenshot">
                @endforeach
            </div>
            @endif
        </div>

        <div class="game-details">
            <div class="game-meta">
                <span><strong>Жанр:</strong> {{ $game->genre }}</span>
                <span><strong>Разработчик:</strong> {{ $game->developer }}</span>
                <span><strong>Дата выхода:</strong> {{ $game->release_date->format('d.m.Y') }}</span>
            </div>

            <div class="game-description">
                <h3>Описание</h3>
                <p>{{ $game->description }}</p>
            </div>

            <div class="game-actions">
                <button class="btn-play">ИГРАТЬ</button>
                <button class="btn-favorites">В избранное</button>
            </div>
        </div>
    </div>
</div>
@endsection