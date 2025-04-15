
@extends('layout.app')

@section('title', 'Edit Recipe')

@section('content')
    <style>
        

        .card {
            background: linear-gradient(45deg, var(--light-color) 0%, #ffffff 100%);
            border: 2px solid var(--primary-color);
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255,107,107,0.1);
        }

        .form-control, .form-select {
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(255,107,107,0.25);
        }

        .alert-danger {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .btn-success {
            background-color: var(--secondary-color);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #FF914D;
            transform: scale(1.05);
        }

        .btn-outline-secondary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        h3 {
            color: var(--dark-color);
            position: relative;
            padding-bottom: 1rem;
        }

        h3:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--secondary-color);
            border-radius: 2px;
        }

        .img-thumbnail {
            border: 2px solid var(--accent-color);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .floating-ingredients {
            position: fixed;
            pointer-events: none;
            z-index: -1;
        }

        .floating-ingredients span {
            position: absolute;
            font-size: 2rem;
            opacity: 0.3;
            animation: float 6s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); }
            100% { transform: translateY(-100vh) rotate(360deg); }
        }

        .chef-bear {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 3rem;
            cursor: pointer;
            z-index: 1000;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>

    
    <div class="chef-bear" onclick="this.style.display='none'">🧑🍳</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded-4 p-4">
                    <h3 class="text-center mb-4">Edit Recipe</h3>
                    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Recipe Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Recipe Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $recipe->description) }}</textarea>
                        </div>

                        <!-- Ingredients -->
                        <div class="mb-3">
                            <label for="ingredient" class="form-label fw-bold">Ingredients</label>
                            <textarea class="form-control" id="ingredient" name="ingredient" rows="6" required>{{ old('ingredient', $recipe->ingredient) }}</textarea>
                        </div>

                        <!-- Instructions -->
                        <div class="mb-3">
                            <label for="instruction" class="form-label fw-bold">Instructions</label>
                            <textarea class="form-control" id="instruction" name="instruction" rows="6" required>{{ old('instruction', $recipe->instruction) }}</textarea>
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label fw-bold">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $recipe->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Recipe Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">Recipe Image (URL)</label>
                            <input type="url" class="form-control" id="image" name="image" placeholder="Enter image URL" value="{{ old('image',$recipe->image) }}">
                        </div>

                        <!-- Image Preview -->
                        <div class="mb-3 text-center">
                            @if($recipe->image)
                                <img id="image-preview" class="img-thumbnail" src="{{ $recipe->image }}" style="max-width: 250px;">
                            @else
                                <img id="image-preview" class="img-thumbnail" src="#" style="display: none; max-width: 250px;">
                            @endif
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary px-4 py-2">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-success px-4 py-2">
                                <i class="fas fa-save"></i> Update Recipe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image Preview Function
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

       
    </script>
    @endpush
@endsection



