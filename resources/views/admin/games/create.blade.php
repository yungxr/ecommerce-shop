@extends('layouts.app')

@section('content')
<div class="admin-form-container">
    <h1 class="color">Добавить игру</h1>

    <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Название</label>
            <input type="text" name="title" id="title" class="@error('title') is-invalid @enderror" value="{{ old('title') }}" required placeholder="Введите название игры">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description" rows="5" class="@error('description') is-invalid @enderror" required placeholder="Введите описание игры">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="price">Цена (руб.)</label>
                <input type="number" step="0.01" name="price" id="price" class="@error('price') is-invalid @enderror" value="{{ old('price') }}" required placeholder="0.00">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="genre">Жанр</label>
                <input type="text" name="genre" id="genre" class="@error('genre') is-invalid @enderror" value="{{ old('genre') }}" required placeholder="Укажите жанр">
                @error('genre')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Обложка</label>
            <input type="file" name="image" id="image" accept="image/*" class="@error('image') is-invalid @enderror" required onchange="previewImage(this)">
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <img id="imagePreview" src="#" alt="Предварительный просмотр" style="max-width: 200px; display: none;">
        </div>

        <div class="form-group">
            <label for="screenshots">Скриншоты (можно несколько)</label>
            <input type="file" name="screenshots[]" id="screenshots" multiple accept="image/*" class="@error('screenshots') is-invalid @enderror" onchange="previewScreenshots(this)">
            @error('screenshots')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="screenshotsPreview"></div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="release_date">Дата выхода</label>
                <input type="date" name="release_date" id="release_date" class="@error('release_date') is-invalid @enderror" value="{{ old('release_date') }}" required>
                @error('release_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="developer">Разработчик</label>
                <input type="text" name="developer" id="developer" class="@error('developer') is-invalid @enderror" value="{{ old('developer') }}" required placeholder="Укажите разработчика">
                @error('developer')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn-submit">Сохранить</button>
    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewScreenshots(input) {
        let preview = document.getElementById('screenshotsPreview');
        preview.innerHTML = ''; // Clear existing previews

        if (input.files) {
            for (let i = 0; i < input.files.length; i++) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.marginRight = '5px';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
</script>
@endsection