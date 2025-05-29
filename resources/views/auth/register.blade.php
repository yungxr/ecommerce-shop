@extends('layouts.auth')

@section('content')
<div class="auth-box">
    <div class="auth-header">
        <div class="logo">
            <span class="logo-icon">🎮</span>
            <span class="logo-text">GameStore</span>
        </div>
        <h1>Создать аккаунт</h1>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf
        <div class="form-group">
            <input id="name" type="text" name="name" required autofocus placeholder=" ">
            <label for="name">Имя</label>
            <span class="input-border"></span>
        </div>

        <div class="form-group">
            <input id="username" type="text" name="username" required placeholder=" ">
            <label for="username">Имя пользователя</label>
            <span class="input-border"></span>
        </div>

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

        <div class="form-group">
            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder=" ">
            <label for="password_confirmation">Подтвердите пароль</label>
            <span class="input-border"></span>
        </div>

        <button type="submit" class="auth-btn">
            <span class="btn-text">Зарегистрироваться</span>
            <i class="fas fa-arrow-right"></i>
        </button>

        <div class="auth-link">
            Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
        </div>
    </form>
</div>
<style>
    /* Auth Container */
    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #1e272e;
        padding: 20px;
    }

    .auth-box {
        width: 100%;
        max-width: 450px;
        background: #2d3436;
        border-radius: 8px;
        padding: 40px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.5s ease;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .auth-header h1 {
        color: #6c5ce7;
        font-size: 1.8rem;
        margin-top: 15px;
    }

    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .logo-icon {
        font-size: 2rem;
    }

    .logo-text {
        color: #fff;
        font-size: 1.8rem;
        font-weight: bold;
        letter-spacing: 1px;
    }

    /* Form Styles */
    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        position: relative;
        margin-bottom: 10px;
    }

    .form-group input {
        width: 100%;
        padding: 15px 0 5px 0;
        background: transparent;
        border: none;
        border-bottom: 2px solid #4b4b4b;
        color: #fff;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-group input:focus {
        outline: none;
        border-color: #6c5ce7;
    }

    .form-group label {
        position: absolute;
        top: 15px;
        left: 0;
        color: #b2b2b2;
        pointer-events: none;
        transition: all 0.3s;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label {
        top: 0;
        font-size: 0.8rem;
        color: #6c5ce7;
    }

    .input-border {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: #6c5ce7;
        transition: width 0.3s;
    }

    .form-group input:focus~.input-border {
        width: 100%;
    }

    /* Button Styles */
    .auth-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        background: #6c5ce7;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        margin-top: 20px;
        transition: all 0.3s;
    }

    .auth-btn:hover {
        background: #5649c0;
        transform: translateY(-2px);
    }

    .btn-text {
        flex-grow: 1;
        text-align: center;
    }

    .auth-btn i {
        transition: transform 0.3s;
    }

    .auth-btn:hover i {
        transform: translateX(3px);
    }

    /* Login Link */
    .auth-link {
        text-align: center;
        color: #b2b2b2;
        margin-top: 20px;
        font-size: 0.9rem;
    }

    .auth-link a {
        color: #6c5ce7;
        text-decoration: none;
        transition: color 0.3s;
    }

    .auth-link a:hover {
        color: #a29bfe;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection