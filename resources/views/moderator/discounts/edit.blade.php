@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-6">Редактировать скидку</h2>
    
    <form action="{{ route('moderator.discounts.update', $discount) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="game_id" class="block text-sm font-medium text-gray-700 mb-1">Игра</label>
            <select name="game_id" id="game_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ $discount->game_id == $game->id ? 'selected' : '' }}>
                        {{ $game->title }} ({{ $game->price }} руб.)
                    </option>
                @endforeach
            </select>
            @error('game_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="percent" class="block text-sm font-medium text-gray-700 mb-1">Процент скидки</label>
            <div class="relative rounded-md shadow-sm">
                <input type="number" name="percent" id="percent" min="1" max="100" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                       value="{{ old('percent', $discount->percent) }}" required>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">%</span>
                </div>
            </div>
            @error('percent')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Дата начала</label>
                <input type="datetime-local" name="start_date" id="start_date" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                       value="{{ old('start_date', $discount->start_date->format('Y-m-d\TH:i')) }}" required>
                @error('start_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Дата окончания</label>
                <input type="datetime-local" name="end_date" id="end_date" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" 
                       value="{{ old('end_date', $discount->end_date->format('Y-m-d\TH:i')) }}" required>
                @error('end_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ $discount->is_active ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-600">Активная скидка</span>
            </label>
        </div>
        
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('moderator.discounts.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Отмена
            </a>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Обновить скидку
            </button>
        </div>
    </form>
</div>

<script>
    // При изменении даты начала обновляем минимальную дату окончания
    document.addEventListener('DOMContentLoaded', function() {
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');
        
        startDate.addEventListener('change', function() {
            endDate.min = this.value;
        });
        
        // Устанавливаем минимальное значение для end_date при загрузке
        if (startDate.value) {
            endDate.min = startDate.value;
        }
    });
</script>
@endsection