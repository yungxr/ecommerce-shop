<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function showTopupForm()
    {
        return view('balance.topup');
    }
    public function topup(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string|size:16|regex:/^[0-9]+$/',
            'amount' => 'required|numeric|min:100|max:10000',
        ]);

        $cardNumber = $request->card_number;
        $amount = $request->amount;

        if (substr($cardNumber, -4) === '1111') {
            return back()->with('error', 'Ошибка: карта недействительна (симуляция)');
        }

        $user = Auth::user();
        $user->increment('balance', $amount);

        Activity::create([
            'user_id' => $user->id,
            'type' => 'topup',
            'description' => 'Пополнение баланса на ' . $amount . ' руб.'
        ]);

        return redirect()->route('profile')->with('success', 'Баланс успешно пополнен на ' . $amount . ' руб.!');
    }
}