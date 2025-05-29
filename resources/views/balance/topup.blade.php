@extends('layouts.app')

@section('content')
<div class="balance-container">
    <h1>Пополнение баланса</h1>
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('balance.topup.submit') }}" class="balance-form">
        @csrf
        
        <div class="form-group">
            <label for="card_number">Номер карты</label>
            <input 
                type="text" 
                id="card_number" 
                name="card_number" 
                placeholder="0000 0000 0000 0000" 
                required
                pattern="[0-9]{16}"
                title="16 цифр без пробелов"
            >
        </div>

        <div class="form-group">
            <label for="amount">Сумма (руб.)</label>
            <input 
                type="number" 
                id="amount" 
                name="amount" 
                min="100" 
                max="10000" 
                step="100" 
                placeholder="1000" 
                required
            >
        </div>

        <button type="submit" class="btn-submit">Пополнить</button>
    </form>
</div>
@endsection