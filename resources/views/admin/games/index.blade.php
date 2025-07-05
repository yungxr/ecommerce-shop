@extends('layouts.app')

@section('content')
<div class="admin-games-container">
    <div class="admin-header">
        <div class="header-content">
            <h1 class="page-title">Управление играми</h1>
            <a href="{{ route('admin.games.create') }}" class="btn-add-game">
                <i class="fas fa-plus"></i> Добавить новую игру
            </a>
        </div>
    </div>

    <div class="admin-content">
        @if(session('success'))
        <h1 class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </h1>
        @endif

        <div class="games-table-container">
            <table class="games-table">
                <thead>
                    <tr>
                        <th class="id-col">Идентификатор</th>
                        <th class="title-col">Название</th>
                        <th class="genre-col">Жанр</th>
                        <th class="price-col">Цена</th>
                        <th class="date-col">Дата выхода</th>
                        <th class="actions-col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game)
                    <tr>
                        <td class="id-col">{{ $game->id }}</td>
                        <td class="title-col">
                            <div class="game-title">
                                @if($game->image)
                                <img src="{{ asset($game->image) }}" alt="{{ $game->title }}" class="game-thumbnail">
                                @endif
                                <span>{{ $game->title }}</span>
                            </div>
                        </td>
                        <td class="genre-col">
                            <span class="genre-badge">{{ $game->genre }}</span>
                        </td>
                        <td class="price-col">
                            @if($game->hasActiveDiscount())
                            <div class="price-with-discount">
                                <span class="original-price">{{ number_format($game->price, 2) }}</span>
                                <span class="discounted-price">${{ number_format($game->discounted_price, 2) }}</span>
                            </div>
                            @else
                            ${{ number_format($game->price, 2) }}
                            @endif
                        </td>
                        <td class="date-col">{{ $game->release_date->format('M d, Y') }}</td>
                        <td class="actions-col">
                            <div class="action-buttons">
                                <a href="{{ route('admin.games.edit', $game) }}" class="btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.games.destroy', $game) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this game?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $games->links() }}
        </div>
    </div>
</div>

<style>
    /* Base Styles */
    .admin-games-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    /* Header Styles */
    .admin-header {
        background: linear-gradient(135deg, #6e8efb, #a777e3);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        color: white;
        font-size: 28px;
        font-weight: 600;
        margin: 0;
    }

    .btn-add-game {
        background-color: white;
        color: #6e8efb;
        padding: 10px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-add-game:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        color: #5a7df4;
    }

    /* Alert Styles */
    .alert {
        border-radius: 8px;
        margin-bottom: 25px;
        color: #fff;
    }

    /* Table Styles */
    .games-table-container {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .games-table {
        width: 100%;
        border-collapse: collapse;
    }

    .games-table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #e9ecef;
    }

    .games-table td {
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    .games-table tr:last-child td {
        border-bottom: none;
    }

    .games-table tr:hover {
        background-color: #f8f9fa;
    }

    /* Column Specific Styles */
    .game-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .game-thumbnail {
        width: 40px;
        height: 40px;
        border-radius: 4px;
        object-fit: cover;
    }

    .genre-badge {
        background-color: #e9f7fe;
        color: #31708f;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 500;
    }

    .price-with-discount {
        display: flex;
        flex-direction: column;
    }

    .original-price {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 13px;
    }

    .discounted-price {
        color: #28a745;
        font-weight: 600;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-edit,
    .btn-delete {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-edit {
        background-color: #ffc107;
        color: white;
    }

    .btn-edit:hover {
        background-color: #e0a800;
        transform: scale(1.1);
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
        transform: scale(1.1);
    }

    /* Pagination Styles */
    .pagination-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .pagination .page-item.active .page-link {
        background-color: #6e8efb;
        border-color: #6e8efb;
    }

    .pagination .page-link {
        color: #6e8efb;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .games-table th,
        .games-table td {
            padding: 10px 8px;
            font-size: 14px;
        }

        .game-title {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .game-thumbnail {
            width: 30px;
            height: 30px;
        }
    }
</style>
@endsection