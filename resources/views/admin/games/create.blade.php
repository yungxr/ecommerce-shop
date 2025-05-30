@extends('layouts.app')

@section('title', isset($game) ? 'Редактирование игры' : 'Добавление игры')

@section('content')
<div class="game-form">
    <h1><i class="fas fa-{{ isset($game) ? 'edit' : 'plus' }}"></i> {{ isset($game) ? 'Редактирование' : 'Добавление' }} игры</h1>

    <form method="POST" 
          action="{{ isset($game) ? route('admin.games.update', $game->id) : route('admin.games.store') }}" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($game)) @method('PUT') @endif

        <div class="form-grid">
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" id="title" name="title" value="{{ $game->title ?? old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="price">Цена (руб.)</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ $game->price ?? old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="genre">Жанр</label>
                <input type="text" id="genre" name="genre" value="{{ $game->genre ?? old('genre') }}" required>
            </div>

            <div class="form-group">
                <label for="developer">Разработчик</label>
                <input type="text" id="developer" name="developer" value="{{ $game->developer ?? old('developer') }}" required>
            </div>

            <div class="form-group">
                <label for="release_date">Дата выхода</label>
                <input type="date" id="release_date" name="release_date" value="{{ isset($game) ? $game->release_date->format('Y-m-d') : old('release_date') }}" required>
            </div>

            <div class="form-group full-width">
                <label for="description">Описание</label>
                <textarea id="description" name="description" rows="5" required>{{ $game->description ?? old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Обложка</label>
                <input type="file" id="image" name="image" {{ !isset($game) ? 'required' : '' }}>
                @if(isset($game) && $game->image)
                    <div class="current-image">
                        <img src="{{ asset('storage/' . $game->image) }}" alt="Current cover" width="100">
                    </div>
                @endif
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Сохранить
        </button>
    </form>
</div>
@endsection