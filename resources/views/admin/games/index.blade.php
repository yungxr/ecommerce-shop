@extends('layouts.app')

@section('content')
<div class="admin-container">
    <h1>Управление играми</h1>
    <a href="{{ route('admin.games.create') }}" class="btn-add">+ Добавить игру</a>
    
    <table class="games-table">
        <!-- Заголовки и вывод игр -->
    </table>
</div>
@endsection