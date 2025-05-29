@extends('layouts.app')

@section('content')
<div class="profile-edit-container">
    <div class="profile-edit-header">
        <h1>Безопасность аккаунта</h1>
    </div>

    <form method="POST" action="{{ route('profile.update-password') }}" class="security-form">
        @csrf
        @method('PUT')

        <div class="form-fields">
            <div class="form-group">
                <label for="current_password">Текущий пароль</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>

            <div class="form-group">
                <label for="password">Новый пароль</label>
                <input type="password" id="password" name="password" required>
                <p class="password-rules">Минимум 8 символов, включая цифры и буквы</p>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Подтвердите новый пароль</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="submit-btn">Изменить пароль</button>
        </div>
    </form>
</div>
@endsection