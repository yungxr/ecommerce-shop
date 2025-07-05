@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Games Management</h1>
        <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Add New Game</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Release Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>
                    <td>{{ $game->title }}</td>
                    <td>{{ $game->genre }}</td>
                    <td>${{ number_format($game->price, 2) }}</td>
                    <td>{{ $game->release_date->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.games.edit', $game) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $games->links() }}
</div>
@endsection