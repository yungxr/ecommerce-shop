@extends('layouts.app')

@section('content')
<div class="profile-edit-container">
    <div class="profile-edit-header">
        <h1>Редактирование профиля</h1>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="profile-edit-form">
        @csrf
        @method('PUT')

        <div class="avatar-section">
            <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                 class="current-avatar" id="avatar-preview">
            <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;">
            <label for="avatar" class="avatar-upload-btn">Выберите файл</label>
            <small>Рекомендуемый размер: 150×150 px</small>
        </div>

        <div class="form-fields">
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
            </div>

            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" value="{{ old('username', auth()->user()->username) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <button type="submit" class="submit-btn">Сохранить изменения</button>
        </div>
    </form>
</div>

<script>
    // Предпросмотр аватара
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection