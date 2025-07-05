<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $games = Game::latest()->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'genre' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'screenshots.*' => 'nullable|image|max:2048',
            'release_date' => 'required|date',
            'developer' => 'required|string|max:255',
            'min_os' => 'required|string|max:255',
            'min_processor' => 'required|string|max:255',
            'min_memory' => 'required|string|max:255',
            'min_graphics' => 'required|string|max:255',
            'min_storage' => 'required|string|max:255',
            'rec_os' => 'required|string|max:255',
            'rec_processor' => 'required|string|max:255',
            'rec_memory' => 'required|string|max:255',
            'rec_graphics' => 'required|string|max:255',
            'rec_storage' => 'required|string|max:255',
        ]);

        // Создаем директории если их нет
        File::ensureDirectoryExists(public_path('images/games'));
        File::ensureDirectoryExists(public_path('images/games/screenshots'));

        // Обработка обложки
        $imageName = Str::slug($validated['title']) . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('images/games'), $imageName);
        $imagePath = 'images/games/' . $imageName;

        // Обработка скриншотов
        $screenshots = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $key => $file) {
                $screenshotName = Str::slug($validated['title']) . '_screenshot_' . ($key + 1) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/games/screenshots'), $screenshotName);
                $screenshots[] = 'images/games/screenshots/' . $screenshotName;
            }
        }

        Game::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'genre' => $validated['genre'],
            'image' => $imagePath,
            'screenshots' => $screenshots,
            'release_date' => $validated['release_date'],
            'developer' => $validated['developer'],
            'system_requirements' => [
                'minimum' => [
                    'os' => $validated['min_os'],
                    'processor' => $validated['min_processor'],
                    'memory' => $validated['min_memory'],
                    'graphics' => $validated['min_graphics'],
                    'storage' => $validated['min_storage']
                ],
                'recommended' => [
                    'os' => $validated['rec_os'],
                    'processor' => $validated['rec_processor'],
                    'memory' => $validated['rec_memory'],
                    'graphics' => $validated['rec_graphics'],
                    'storage' => $validated['rec_storage']
                ]
            ]
        ]);

        return redirect()->route('admin.games.index')->with('success', 'Game added successfully!');
    }

    public function edit(Game $game)
    {
        // Приводим system_requirements к массиву, если это JSON строка
        if (is_string($game->system_requirements)) {
            $game->system_requirements = json_decode($game->system_requirements, true);
        }

        return view('admin.games.edit', [
            'game' => $game,
            'requirements' => $game->system_requirements ?? [
                'minimum' => [
                    'os' => '',
                    'processor' => '',
                    'memory' => '',
                    'graphics' => '',
                    'storage' => ''
                ],
                'recommended' => [
                    'os' => '',
                    'processor' => '',
                    'memory' => '',
                    'graphics' => '',
                    'storage' => ''
                ]
            ]
        ]);
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'genre' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'screenshots.*' => 'nullable|image|max:2048',
            'release_date' => 'required|date',
            'developer' => 'required|string|max:255',
            'min_os' => 'required|string|max:255',
            'min_processor' => 'required|string|max:255',
            'min_memory' => 'required|string|max:255',
            'min_graphics' => 'required|string|max:255',
            'min_storage' => 'required|string|max:255',
            'rec_os' => 'required|string|max:255',
            'rec_processor' => 'required|string|max:255',
            'rec_memory' => 'required|string|max:255',
            'rec_graphics' => 'required|string|max:255',
            'rec_storage' => 'required|string|max:255',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'genre' => $validated['genre'],
            'release_date' => $validated['release_date'],
            'developer' => $validated['developer'],
            'system_requirements' => [
                'minimum' => [
                    'os' => $validated['min_os'],
                    'processor' => $validated['min_processor'],
                    'memory' => $validated['min_memory'],
                    'graphics' => $validated['min_graphics'],
                    'storage' => $validated['min_storage']
                ],
                'recommended' => [
                    'os' => $validated['rec_os'],
                    'processor' => $validated['rec_processor'],
                    'memory' => $validated['rec_memory'],
                    'graphics' => $validated['rec_graphics'],
                    'storage' => $validated['rec_storage']
                ]
            ]
        ];

        // Обновление обложки
        if ($request->hasFile('image')) {
            // Удаляем старую обложку
            if ($game->image && File::exists(public_path($game->image))) {
                File::delete(public_path($game->image));
            }

            $imageName = Str::slug($validated['title']) . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/games'), $imageName);
            $data['image'] = 'images/games/' . $imageName;
        }

        // Обновление скриншотов
        if ($request->hasFile('screenshots')) {
            // Удаляем старые скриншоты
            $oldScreenshots = $game->screenshots ?? [];
            foreach ($oldScreenshots as $screenshot) {
                if ($screenshot && File::exists(public_path($screenshot))) {
                    File::delete(public_path($screenshot));
                }
            }

            // Сохраняем новые
            $screenshots = [];
            foreach ($request->file('screenshots') as $key => $file) {
                $screenshotName = Str::slug($validated['title']) . '_screenshot_' . ($key + 1) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/games/screenshots'), $screenshotName);
                $screenshots[] = 'images/games/screenshots/' . $screenshotName;
            }
            $data['screenshots'] = $screenshots;
        }

        $game->update($data);

        return redirect()->route('admin.games.index')->with('success', 'Игра успешно обновлена!');
    }

    public function destroy(Game $game)
    {
        // Удаляем обложку
        if (File::exists(public_path($game->image))) {
            File::delete(public_path($game->image));
        }

        // Удаляем скриншоты
        $screenshots = is_array($game->screenshots) ? $game->screenshots : [];
        foreach ($screenshots as $screenshot) {
            if (File::exists(public_path($screenshot))) {
                File::delete(public_path($screenshot));
            }
        }

        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Game deleted successfully!');
    }
}
