@extends('layouts.auth')

@section('content')
<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <div class="logo">
                <span class="logo-icon">🎮</span>
                <span class="logo-text">GameStore</span>
            </div>
            <h1>Вход в аккаунт</h1>
        </div>

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password" placeholder="Пароль">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group remember">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Запомнить меня
                    </label>
                </div>
            </div>

            <button type="submit" class="login-button">
                Войти
            </button>

            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
            @endif

            <div class="register-link">
                Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
            </div>
        </form>
    </div>
</div>
@endsection