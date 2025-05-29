@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-header" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1542751371-adc38448a05e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
        <div class="profile-avatar">
            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}" alt="Avatar">
        </div>
        <div class="profile-info">
            <h1>{{ $user->username }}</h1>
            <div class="profile-level">
                Уровень: {{ $user->level }}
                <div class="level-bar">
                    <div class="level-progress" style="width: {{ ($user->experience / ($user->level * 200)) * 100 }}%"></div>
                </div>
                <small>Опыт: {{ $user->experience }}/{{ $user->level * 200 }}</small>
            </div>
            <div class="profile-stats">
                <div class="stat">
                    <span class="stat-value">{{ $user->balance }}</span>
                    <span class="stat-label">Баланс</span>
                    <a href="{{ route('balance.topup') }}" class="btn-topup"
                        style="margin-left: 5px; padding: 3px 8px; 
                  background: #2196F3; color: white; border-radius: 4px; 
                  font-size: 12px; text-decoration: none;">
                        <i class="fas fa-plus"></i> Пополнить
                    </a>
                </div>
                <div class="stat">
                    <span class="stat-value">{{ $user->libraryGames()->count() }}</span>
                    <span class="stat-label">Игр</span>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="profile-sidebar">
            <div class="sidebar-section">
                <h3>Настройки</h3>
                <ul>
                    <li><a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">Профиль</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">Редактировать</a></li>
                    <li><a href="{{ route('profile.security') }}" class="{{ request()->routeIs('profile.security') ? 'active' : '' }}">Безопасность</a></li>
                </ul>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Выйти
                    </button>
                </form>
            </div>
        </div>

        <div class="profile-main">
            <div class="profile-section">
                <h2>Моя библиотека</h2>
                @if($user->libraryGames->isEmpty())
                <div class="game-empty">
                    <p>У вас пока нет игр</p>
                    <a href="{{ route('shop.index') }}" class="btn-buy">Перейти в магазин</a>
                </div>
                @else
                <div class="games-grid">
                    @foreach($user->libraryGames as $game)
                    <div class="game-card">
                        <a href="{{ route('library.show', $game) }}">
                            <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}">
                            <div class="game-info">
                                <h3>{{ $game->title }}</h3>
                                <span class="game-date">Приобретено: {{ $game->pivot->created_at->format('d.m.Y') }}</span>
                            </div>
                        </a>
                        <button class="btn-play">Играть</button>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="profile-section">
                <h2>Последняя активность</h2>
                @if($user->activities->isEmpty())
                <div class="activity-empty">
                    <p>Активность отсутствует</p>
                </div>
                @else
                <div class="activity-feed">
                    @foreach($user->activities->take(5) as $activity)
                    <div class="activity-item">
                        @if($activity->type === 'purchase')
                        <i class="fas fa-shopping-cart activity-icon"></i>
                        Куплена игра: {{ $activity->description }}
                        @elseif($activity->type === 'level_up')
                        <i class="fas fa-level-up-alt activity-icon"></i>
                        {{ $activity->description }}
                        @endif
                        <small class="activity-time">{{ $activity->created_at->diffForHumans() }}</small>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection