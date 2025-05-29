@extends('layouts.auth')

@section('content')
<div class="auth-box">
    <div class="auth-header">
        <div class="logo">
            <span class="logo-icon">🎮</span>
            <span class="logo-text">GameStore</span>
        </div>
        <h1>Вход в аккаунт</h1>
    </div>

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <input id="email" type="email" name="email" required placeholder=" ">
            <label for="email">Email</label>
            <span class="input-border"></span>
        </div>

        <div class="form-group">
            <input id="password" type="password" name="password" required placeholder=" ">
            <label for="password">Пароль</label>
            <span class="input-border"></span>
        </div>

        <button type="submit" class="auth-btn">
            <span class="btn-text">Войти</span>
            <i class="fas fa-arrow-right"></i>
        </button>

        <div class="auth-link">
            Еще не зарегистрированы? <a href="{{ route('register') }}">Войти</a>
        </div>
    </form>
</div>
@endsection