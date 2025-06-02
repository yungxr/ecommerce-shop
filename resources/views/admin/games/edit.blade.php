@extends('layouts.app')

@section('content')
<div class="admin-form-container">
    <h1 class="color">Редактировать игру: {{ $game->title }}</h1>

    <form action="{{ route('admin.games.update', $game) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Название</label>
            <input type="text" name="title" value="{{ old('title', $game->title) }}" required>
        </div>

        <div class="form-group">
            <label>Описание</label>
            <textarea name="description" rows="5" required>{{ old('description', $game->description) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Цена (руб.)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $game->price) }}" required>
            </div>
            <div class="form-group">
                <label>Жанр</label>
                <input type="text" name="genre" value="{{ old('genre', $game->genre) }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Текущая обложка:</label>
            <img src="{{ asset('images/games/' . $game->image) }}" width="100">
            <label>Новая обложка (оставьте пустым, чтобы не менять)</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label>Текущие скриншоты:</label>
            @foreach(json_decode($game->screenshots) as $screenshot)
            <img src="{{ asset('images/games/screenshots/' . $screenshot) }}" width="100">
            @endforeach
            <label>Новые скриншоты (можно несколько)</label>
            <input type="file" name="screenshots[]" multiple accept="image/*">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Дата выхода</label>
                <input type="date" name="release_date" value="{{ old('release_date', $game->release_date->format('Y-m-d')) }}" required>
            </div>
            <div class="form-group">
                <label>Разработчик</label>
                <input type="text" name="developer" value="{{ old('developer', $game->developer) }}" required>
            </div>
        </div>

        <button type="submit" class="btn-submit">Обновить</button>
    </form>
</div>
@endsection