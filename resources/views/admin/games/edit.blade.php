@extends('layouts.app')

@section('content')
<style>
    .game-form {
        --primary-color: #2563eb;
        --primary-hover: #1d4ed8;
        --secondary-color: #6b7280;
        --secondary-hover: #4b5563;
        --border-color: #e5e7eb;
        --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .game-form h1 {
        font-size: 1.8rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--border-color);
    }
    
    .game-form .card {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
        background: #fff;
    }
    
    .game-form .card-header {
        background: #f9fafb;
        border-bottom: 1px solid var(--border-color);
        padding: 0.75rem 1.25rem;
        font-weight: 600;
        color: #374151;
    }
    
    .game-form .card-body {
        padding: 1.25rem;
    }
    
    .game-form .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #374151;
        font-size: 0.875rem;
    }
    
    .game-form .form-control {
        display: block;
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 0.375rem;
        font-size: 0.875rem;
        line-height: 1.25;
        color: #111827;
        transition: border-color 0.15s;
    }
    
    .game-form .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    
    .game-form textarea.form-control {
        min-height: 120px;
    }
    
    .game-form .btn-submit {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 0.625rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background 0.15s;
        margin-right: 0.75rem;
    }
    
    .game-form .btn-submit:hover {
        background: var(--primary-hover);
    }
    
    .game-form .btn-cancel {
        background: var(--secondary-color);
        color: white;
        border: none;
        padding: 0.625rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background 0.15s;
    }
    
    .game-form .btn-cancel:hover {
        background: var(--secondary-hover);
    }
    
    .game-form .image-preview {
        margin-top: 1rem;
    }
    
    .game-form .image-preview img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 0.375rem;
        border: 1px solid var(--border-color);
    }
    
    .game-form .screenshots-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    .game-form .screenshots-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 0.375rem;
        border: 1px solid var(--border-color);
    }
    
    .game-form .current-images {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    
    .game-form .current-images img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 0.375rem;
        border: 1px solid var(--border-color);
    }
    
    .game-form .current-cover {
        max-width: 100%;
        max-height: 200px;
        border-radius: 0.375rem;
        border: 1px solid var(--border-color);
        margin-bottom: 1rem;
    }
    
    .game-form .text-muted {
        color: #6b7280;
        font-size: 0.75rem;
        display: block;
        margin-top: 0.25rem;
    }
    
    .game-form .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1rem;
    }
    
    .game-form .buttons-container {
        display: flex;
        margin-top: 1.5rem;
    }
</style>

<div class="container py-4 game-form">
    <h1>Edit Game: {{ $game->title }}</h1>

    <form action="{{ route('admin.games.update', $game) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Game Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $game->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $game->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $game->price) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $game->genre) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Current Cover</label>
                            <div>
                                @if($game->image)
                                    <img src="{{ asset($game->image) }}" class="current-cover">
                                @else
                                    <p class="text-muted">No cover image</p>
                                @endif
                            </div>
                            <label for="image" class="form-label">New Cover</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <span class="text-muted">Leave empty to keep current image</span>
                            <div id="imagePreview" class="image-preview"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Screenshots</label>
                            <div class="current-images">
                                @php
                                    $screenshots = is_array($game->screenshots) ? $game->screenshots : [];
                                @endphp
                                @foreach($screenshots as $screenshot)
                                    @if($screenshot)
                                        <img src="{{ asset($screenshot) }}" alt="Screenshot">
                                    @endif
                                @endforeach
                                @if(count($screenshots) === 0)
                                    <p class="text-muted">No screenshots</p>
                                @endif
                            </div>
                            <label for="screenshots" class="form-label">New Screenshots</label>
                            <input type="file" class="form-control" id="screenshots" name="screenshots[]" multiple>
                            <span class="text-muted">Select multiple files to add to existing screenshots</span>
                            <div id="screenshotsPreview" class="screenshots-preview"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="date" class="form-control" id="release_date" name="release_date" 
                                   value="{{ old('release_date', $game->release_date ? $game->release_date->format('Y-m-d') : '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="developer" class="form-label">Developer</label>
                            <input type="text" class="form-control" id="developer" name="developer" value="{{ old('developer', $game->developer) }}" required>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">System Requirements</div>
                    <div class="card-body">
                        @php
                            $requirements = is_array($game->system_requirements) ? $game->system_requirements : [
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
                            ];
                        @endphp

                        <h5 class="section-title">Minimum</h5>
                        <div class="mb-3">
                            <label for="min_os" class="form-label">OS</label>
                            <input type="text" class="form-control" id="min_os" name="min_os" 
                                   value="{{ old('min_os', $requirements['minimum']['os'] ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_processor" class="form-label">Processor</label>
                            <input type="text" class="form-control" id="min_processor" name="min_processor" 
                                   value="{{ old('min_processor', $requirements['minimum']['processor'] ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_memory" class="form-label">Memory</label>
                            <input type="text" class="form-control" id="min_memory" name="min_memory" 
                                   value="{{ old('min_memory', $requirements['minimum']['memory'] ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_graphics" class="form-label">Graphics</label>
                            <input type="text" class="form-control" id="min_graphics" name="min_graphics" 
                                   value="{{ old('min_graphics', $requirements['minimum']['graphics'] ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_storage" class="form-label">Storage</label>
                            <input type="text" class="form-control" id="min_storage" name="min_storage" 
                                   value="{{ old('min_storage', $requirements['minimum']['storage'] ?? '') }}" required>
                        </div>

                        <h5 class="section-title">Recommended</h5>
                        <div class="mb-3">
                            <label for="rec_os" class="form-label">OS</label>
                            <input type="text" class="form-control" id="rec_os" name="rec_os" 
                                   value="{{ old('rec_os', $requirements['recommended']['os'] ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="rec_processor" class="form-label">Processor</label>
                            <input type="text" class="form-control" id="rec_processor" name="rec_processor" 
                                   value="{{ old('rec_processor', $requirements['recommended']['processor'] ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="rec_memory" class="form-label">Memory</label>
                            <input type="text" class="form-control" id="rec_memory" name="rec_memory" 
                                   value="{{ old('rec_memory', $requirements['recommended']['memory'] ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="rec_graphics" class="form-label">Graphics</label>
                            <input type="text" class="form-control" id="rec_graphics" name="rec_graphics" 
                                   value="{{ old('rec_graphics', $requirements['recommended']['graphics'] ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="rec_storage" class="form-label">Storage</label>
                            <input type="text" class="form-control" id="rec_storage" name="rec_storage" 
                                   value="{{ old('rec_storage', $requirements['recommended']['storage'] ?? '') }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="buttons-container">
            <button type="submit" class="btn-submit">Update Game</button>
            <a href="{{ route('admin.games.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cover image preview
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Cover preview">
                    `;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Screenshots preview
    const screenshotsInput = document.getElementById('screenshots');
    if (screenshotsInput) {
        screenshotsInput.addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('screenshotsPreview');
            preview.innerHTML = '';

            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = `Screenshot ${i+1}`;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(files[i]);
            }
        });
    }
});
</script>
@endsection