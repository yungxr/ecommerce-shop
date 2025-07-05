<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore - Интернет-магазин компьютерных игр</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="site-container">
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="/" class="logo">
                    <span class="logo__icon">🎮</span>
                    <span class="logo__text">GameStore</span>
                </a>

                <nav class="nav">
                    <a href="/" class="nav__link">Главная</a>
                    <a href="/shop" class="nav__link">Магазин</a>
                    <a href="/library" class="nav__link">Библиотека</a>

                    @auth
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.games.index') }}" class="nav__link">Админ-панель</a>
                    @endif
                    @endauth

                    @auth
                    @if(auth()->user()->role === 'moderator')
                    <a class="nav__link" href="{{ route('moderator.discounts.index') }}">Мод-панель</a>
                    @endif
                    @endauth

                    @auth
                    <a href="{{ route('wishlist.index') }}" class="nav__link">
                        <i class="fas fa-heart"></i> Вишлист
                        @if(auth()->user()->wishlist()->count() > 0)
                        <span class="wishlist-count">
                            {{ auth()->user()->wishlist()->count() }}
                        </span>
                        @endif
                    </a>
                    @endauth
                </nav>

                <a href="{{ route('cart.index') }}" class="cart-link">
                    <i class="fas fa-shopping-cart"></i>
                    @auth
                    <span class="cart-count">{{ auth()->user()->cartItems()->count() }}</span>
                    @endauth
                </a>

                <div class="user-menu">
                    <a href="{{ route('profile') }}" class="user-menu__link">
                        <span>{{ Auth::user()->username }}</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="site-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer__inner">
                <div class="footer__col">
                    <h3 class="footer__title">GameStore</h3>
                    <p class="footer__text">Лучшие компьютерные игры по доступным ценам</p>
                </div>
                <div class="footer__col">
                    <h3 class="footer__title">Контакты</h3>
                    <p class="footer__text">Email: info@gamestore.com</p>
                    <p class="footer__text">Телефон: +7 (123) 456-78-90</p>
                </div>
                <div class="footer__col">
                    <h3 class="footer__title">Соцсети</h3>
                    <div class="social-links">
                        <a href="#" class="social-link">VK</a>
                        <a href="#" class="social-link">Telegram</a>
                        <a href="#" class="social-link">YouTube</a>
                    </div>
                </div>
            </div>
            <div class="footer__copyright">
                &copy; 2025 GameStore. Все права защищены.
            </div>
        </div>
    </footer>
    <script>
        // Предпросмотр аватара перед загрузкой
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
</body>

</html>