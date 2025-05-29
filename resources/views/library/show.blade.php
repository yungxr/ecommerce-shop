@extends('layouts.app')

@section('content')
<div class="game-detail-container">
    <div class="game-main">
        <div class="game-gallery">
            <div class="main-image">
                <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}">
            </div>
            <div class="screenshots">
                @foreach($screenshots as $screenshot)
                <img src="{{ asset('images/games/screenshots/' . $screenshot) }}" alt="Скриншот">
                @endforeach
            </div>
        </div>

        <div class="game-info">
            <h1>{{ $game->title }}</h1>
            <div class="meta">
                <span class="developer">{{ $game->developer }}</span>
                <span class="release-date">Дата выхода: {{ $game->release_date->format('d.m.Y') }}</span>
                <span class="genre">{{ $game->genre }}</span>
                <span class="purchase-date">Приобретено: {{ $purchased_at->format('d.m.Y H:i') }}</span>
            </div>

            <div class="price-block">
                <button class="btn-play-big">ИГРАТЬ</button>
            </div>

            <div class="description">
                <h3>Описание</h3>
                <p>{{ $game->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection