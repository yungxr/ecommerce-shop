@extends('layouts.app')

@section('content')
<div class="game-detail-container">
    <!-- Ваш существующий код игры -->
    <div class="game-main">
        <div class="game-gallery">
            <div class="main-image">
                <img src="{{ asset('images/games/' . $game->image) }}" alt="{{ $game->title }}">
            </div>
            <div class="screenshots">
                @if($game->screenshots)
                @foreach(json_decode($game->screenshots, true) as $screenshot)
                <img src="{{ asset('images/games/screenshots/' . $screenshot) }}" alt="Скриншот">
                @endforeach
                @else
                <p>Скриншотов нет</p>
                @endif
            </div>
        </div>

        <div class="game-info">
            <h1>{{ $game->title }}</h1>
            <div class="meta">
                <span class="developer">{{ $game->developer }}</span>
                <span class="release-date">Дата выхода: {{ $game->release_date->format('d.m.Y') }}</span>
                <span class="genre">{{ $game->genre }}</span>
            </div>

            <div class="price-block">
                <form action="{{ route('cart.add', $game) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-buy">В корзину</button>
                </form>
            </div>

            <div class="description">
                <h3>Описание</h3>
                <p>{{ $game->description }}</p>
            </div>
        </div>
    </div>

    <!-- Блок отзывов -->
    <div class="reviews-section">
        <div class="reviews-header">
            <h3 class="reviews-title">Отзывы <span class="reviews-count">({{ $game->reviews->count() }})</span></h3>
            <div class="average-rating">
                Средний рейтинг: <span class="rating-value">{{ number_format($game->averageRating(), 1) }} ★</span>
            </div>
            
            @auth
                @if(!$game->reviews->where('user_id', auth()->id())->count())
                    <button class="add-review-btn" onclick="document.getElementById('review-form-container').style.display='block'">Оставить отзыв</button>
                @endif
            @endauth
        </div>

        <!-- Форма отзыва (изначально скрыта) -->
        @auth
        <div id="review-form-container" style="display: none; margin-top: 20px;">
            <form action="{{ route('reviews.store', $game) }}" method="POST" class="review-form">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Ваша оценка:</label>
                    <select class="select-box" name="rating" style="padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
                        <option value="5">5 ★</option>
                        <option value="4">4 ★</option>
                        <option value="3">3 ★</option>
                        <option value="2">2 ★</option>
                        <option value="1">1 ★</option>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Текст отзыва:</label>
                    <textarea name="comment" rows="4" style="width: 100%; padding: 8px; border-radius: 4px;"></textarea>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="submit" style="background: #4CAF50; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Отправить</button>
                    <button type="button" onclick="document.getElementById('review-form-container').style.display='none'" style="background: #f44336; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Отмена</button>
                </div>
            </form>
        </div>
        @endauth

        <div class="reviews-list">
            @foreach($game->reviews as $review)
            <div class="review-item">
                <div class="review-header">
                    <div class="review-author">
                        <img src="{{ $review->user->avatar ? asset('storage/'.$review->user->avatar) : asset('images/default-avatar.png') }}" 
                             alt="Аватар" class="user-avatar">
                        <strong>{{ $review->user->username }}</strong>
                    </div>
                    <div class="review-meta">
                        <span class="review-rating">{{ $review->rating }} ★</span>
                        <span class="review-date">{{ $review->created_at->format('d.m.Y') }}</span>
                    </div>
                </div>
                
                @if($review->comment)
                <div class="review-content">
                    <p>{{ $review->comment }}</p>
                </div>
                @endif

                @if(auth()->id() === $review->user_id)
                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="delete-review-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-review-btn">Удалить отзыв</button>
                </form>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
