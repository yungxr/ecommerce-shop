<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGameController extends Controller
{
    // Список игр
    public function index()
    {
        $games = Game::latest()->get();
        return view('admin.games.index', compact('games'));
    }

    // Форма создания
    public function create()
    {
        return view('admin.games.create');
    }

    // Сохранение игры
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'genre' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'release_date' => 'required|date',
            'developer' => 'required|string',
        ]);

        // Сохраняем обложку
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images/games'), $imageName);
        $validated['image'] = $imageName;

        // Сохраняем скриншоты
        if ($request->hasFile('screenshots')) {
            $screenshots = [];
            foreach ($request->file('screenshots') as $file) {
                $screenshotName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/games/screenshots'), $screenshotName);
                $screenshots[] = $screenshotName;
            }
            $validated['screenshots'] = json_encode($screenshots);
        }

        Game::create($validated);
        return redirect()->route('admin.games.index')->with('success', 'Игра добавлена!');
    }

    // Форма редактирования
    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    // Обновление игры
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'genre' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'release_date' => 'required|date',
            'developer' => 'required|string',
        ]);

        // Обновляем обложку
        if ($request->hasFile('image')) {
            // Удаляем старую обложку
            if (file_exists(public_path('images/games/' . $game->image))) {
                unlink(public_path('images/games/' . $game->image));
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images/games'), $imageName);
            $validated['image'] = $imageName;
        }

        // Обновляем скриншоты
        if ($request->hasFile('screenshots')) {
            // Удаляем старые скриншоты
            $oldScreenshots = json_decode($game->screenshots, true) ?? [];
            foreach ($oldScreenshots as $screenshot) {
                if (file_exists(public_path('images/games/screenshots/' . $screenshot))) {
                    unlink(public_path('images/games/screenshots/' . $screenshot));
                }
            }

            $screenshots = [];
            foreach ($request->file('screenshots') as $file) {
                $screenshotName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/games/screenshots'), $screenshotName);
                $screenshots[] = $screenshotName;
            }
            $validated['screenshots'] = json_encode($screenshots);
        }

        $game->update($validated);
        return redirect()->route('admin.games.index')->with('success', 'Игра обновлена!');
    }

    // Удаление игры
    public function destroy(Game $game)
    {
        // Удаляем связанные записи в library_items
        \DB::table('library_items')->where('game_id', $game->id)->delete();

        // Удаляем изображения
        if (file_exists(public_path('images/games/' . $game->image))) {
            unlink(public_path('images/games/' . $game->image));
        }

        $screenshots = json_decode($game->screenshots, true) ?? [];
        foreach ($screenshots as $screenshot) {
            if (file_exists(public_path('images/games/screenshots/' . $screenshot))) {
                unlink(public_path('images/games/screenshots/' . $screenshot));
            }
        }

        // Удаляем саму игру
        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Игра удалена!');
    }
}
