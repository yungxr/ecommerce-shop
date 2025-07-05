@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Add New Game</h1>

    <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Game Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <input type="text" class="form-control" id="genre" name="genre" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Cover Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                            <div id="imagePreview" class="mt-2"></div>
                        </div>

                        <div class="mb-3">
                            <label for="screenshots" class="form-label">Screenshots (Multiple)</label>
                            <input type="file" class="form-control" id="screenshots" name="screenshots[]" multiple>
                            <div id="screenshotsPreview" class="d-flex flex-wrap mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="date" class="form-control" id="release_date" name="release_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="developer" class="form-label">Developer</label>
                            <input type="text" class="form-control" id="developer" name="developer" required>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">System Requirements</div>
                    <div class="card-body">
                        <h5 class="card-title">Minimum</h5>
                        <div class="mb-3">
                            <label for="min_os" class="form-label">OS</label>
                            <input type="text" class="form-control" id="min_os" name="min_os" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_processor" class="form-label">Processor</label>
                            <input type="text" class="form-control" id="min_processor" name="min_processor" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_memory" class="form-label">Memory</label>
                            <input type="text" class="form-control" id="min_memory" name="min_memory" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_graphics" class="form-label">Graphics</label>
                            <input type="text" class="form-control" id="min_graphics" name="min_graphics" required>
                        </div>
                        <div class="mb-3">
                            <label for="min_storage" class="form-label">Storage</label>
                            <input type="text" class="form-control" id="min_storage" name="min_storage" required>
                        </div>

                        <h5 class="card-title mt-4">Recommended</h5>
                        <div class="mb-3">
                            <label for="rec_os" class="form-label">OS</label>
                            <input type="text" class="form-control" id="rec_os" name="rec_os" required>
                        </div>
                        <div class="mb-3">
                            <label for="rec_processor" class="form-label">Processor</label>
                            <input type="text" class="form-control" id="rec_processor" name="rec_processor" required>
                        </div>
                        <div class="mb-3">
                            <label for="rec_memory" class="form-label">Memory</label>
                            <input type="text" class="form-control" id="rec_memory" name="rec_memory" required>
                        </div>
                        <div class="mb-3">
                            <label for="rec_graphics" class="form-label">Graphics</label>
                            <input type="text" class="form-control" id="rec_graphics" name="rec_graphics" required>
                        </div>
                        <div class="mb-3">
                            <label for="rec_storage" class="form-label">Storage</label>
                            <input type="text" class="form-control" id="rec_storage" name="rec_storage" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Game</button>
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
                        <img src="${e.target.result}" class="img-thumbnail" style="max-height: 200px;">
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
                    img.className = 'img-thumbnail mr-2 mb-2';
                    img.style.maxHeight = '100px';
                    preview.appendChild(img);
                }
                reader.readAsDataURL(files[i]);
            }
        });
    }
});
</script>
@endsection