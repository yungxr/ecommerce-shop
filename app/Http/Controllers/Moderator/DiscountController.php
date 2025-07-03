<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('game')->latest()->paginate(10);
        return view('moderator.discounts.index', compact('discounts'));
    }

    public function create()
    {
        $games = Game::all();
        return view('moderator.discounts.create', compact('games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'percent' => 'required|numeric|min:1|max:100',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        Discount::create($validated);

        return redirect()->route('moderator.discounts.index')
                         ->with('success', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
        $games = Game::all();
        return view('moderator.discounts.edit', compact('discount', 'games'));
    }

    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'percent' => 'required|numeric|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $discount->update($validated);

        return redirect()->route('moderator.discounts.index')
                         ->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('moderator.discounts.index')
                         ->with('success', 'Discount deleted successfully.');
    }

    public function toggle(Discount $discount)
    {
        $discount->update(['is_active' => !$discount->is_active]);
        return back()->with('success', 'Discount status updated.');
    }
}