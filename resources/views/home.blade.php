@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="container">
        <h1 class="hero__title">Добро пожаловать в GameStore</h1>
        <p class="hero__text">Лучший выбор компьютерных игр для настоящих геймеров</p>
        <a href="/shop" class="hero__button">Перейти в магазин</a>
    </div>
</section>

<!-- Новая секция скидок -->
<section class="discounts">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">🔥 Выгодные предложения</h2>
            <a href="{{ route('shop.index', ['discounts' => 'active']) }}" class="all-discounts-button">
                Все акции <span>&rarr;</span>
            </a>
        </div>
        <div class="discounts__grid">
            @forelse($discountedGames as $game)
            <div class="discount-card">
                <a href="{{ route('shop.show', $game) }}">
                    <div class="discount-badge">
                        -{{ $game->discounts->first()->percent }}%
                        <div class="discount-timer" data-end="{{ $game->discounts->first()->end_date->format('Y-m-d H:i:s') }}">
                            <span class="timer-days">00</span>д
                            <span class="timer-hours">00</span>:<span class="timer-minutes">00</span>:<span class="timer-seconds">00</span>
                        </div>
                    </div>
                    <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}" class="discount-card__image">
                    <div class="discount-card__info">
                        <h3 class="discount-card__title">{{ $game->title }}</h3>
                        <div class="discount-card__prices">
                            <span class="original-price">{{ number_format($game->price, 0, ',', ' ') }} ₽</span>
                            <span class="current-price">{{ number_format($game->discounted_price, 0, ',', ' ') }} ₽</span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <p class="no-discounts">Сейчас нет игр со скидками, но скоро появятся!</p>
            @endforelse
        </div>
    </div>
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timers = document.querySelectorAll('.discount-timer');

            function updateTimers() {
                timers.forEach(timer => {
                    const endDate = new Date(timer.dataset.end).getTime();
                    const now = new Date().getTime();
                    const distance = endDate - now;

                    if (distance < 0) {
                        timer.innerHTML = "Акция завершена";
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    timer.querySelector('.timer-days').textContent = days;
                    timer.querySelector('.timer-hours').textContent = String(hours).padStart(2, '0');
                    timer.querySelector('.timer-minutes').textContent = String(minutes).padStart(2, '0');
                    timer.querySelector('.timer-seconds').textContent = String(seconds).padStart(2, '0');
                });
            }

            updateTimers();
            setInterval(updateTimers, 1000);
        });
    </script>

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