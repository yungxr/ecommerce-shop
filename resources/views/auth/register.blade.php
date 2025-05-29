@extends('layouts.auth')

@section('content')
<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <div class="logo">
                <span class="logo-icon">🎮</span>
                <span class="logo-text">GameStore</span>
            </div>
            <h1>Регистрация</h1>
        </div>

        <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label for="name">Имя</label>
                    <input id="name" type="text" name="name" required autofocus>
                </div>
                <div>
                    <label for="username">Имя пользователя</label>
                    <input id="username" type="text" name="username" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>
                </div>
                <div>
                    <label for="password">Пароль</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div>
                    <label for="password_confirmation">Подтверждение пароля</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                </div>
                <button type="submit">Зарегистрироваться</button>
            </form>
    </div>
</div>
@endsection