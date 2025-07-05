@extends('layouts.app')

@section('content')
<div class="game-detail-container">
    <div class="game-main">
        <div class="game-gallery">
            <div class="main-image">
                @if($game->image)
                    <img src="{{ asset($game->image) }}" alt="{{ $game->title }}">
                @else
                    <img src="{{ asset('images/games/default.jpg') }}" alt="Изображение отсутствует">
                @endif
            </div>
            <div class="screenshots">
                @if(count($screenshots) > 0)
                    @foreach($screenshots as $screenshot)
                        @if($screenshot)
                            <img src="{{ asset($screenshot) }}" alt="Скриншот">
                        @endif
                    @endforeach
                @else
                    <p>Скриншотов нет</p>
                @endif
            </div>
        </div>

        <div class="game-info">
            <h1 class="color-txt">{{ $game->title }}</h1>
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