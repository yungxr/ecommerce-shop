@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="container">
            <h1 class="hero__title">Добро пожаловать в GameStore</h1>
            <p class="hero__text">Лучший выбор компьютерных игр для настоящих геймеров</p>
            <a href="/shop" class="hero__button">Перейти в магазин</a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">Почему выбирают нас?</h2>
            <div class="features__grid">
                <div class="feature">
                    <div class="feature__icon">⚡</div>
                    <h3 class="feature__title">Мгновенная доставка</h3>
                    <p class="feature__text">Получите ключ активации сразу после оплаты</p>
                </div>
                <div class="feature">
                    <div class="feature__icon">💰</div>
                    <h3 class="feature__title">Лучшие цены</h3>
                    <p class="feature__text">Регулярные скидки и специальные предложения</p>
                </div>
                <div class="feature">
                    <div class="feature__icon">🛡️</div>
                    <h3 class="feature__title">Гарантия качества</h3>
                    <p class="feature__text">Только лицензионные ключи от официальных издателей</p>
                </div>
            </div>
        </div>
    </section>
@endsection