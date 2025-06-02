@extends('layouts.app')

@section('content')
<div class="admin-container">
    <h1 class="text-col">Управление играми</h1>
    
    <div class="admin-actions">
        <a href="{{ route('admin.games.create') }}" class="btn-add">Добавить игру</a>
    </div>

    <div class="games-list">
        @foreach($games as $game)
        <div class="game-item">
            <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}">
            <div class="game-details">
                <h3 class="color">{{ $game->title }}</h3>
                <span class="price">{{ $game->price }} руб.</span>
                <span class="genre">{{ $game->genre }}</span>
            </div>
            <div class="game-actions">
                <a href="{{ route('admin.games.edit', $game) }}" class="btn-edit">Редактировать</a>
                <form action="{{ route('admin.games.destroy', $game) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Удалить</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection