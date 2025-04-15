
@extends('layouts.admin')

@section('content')
    <style>
        :root {
            --primary-color: #FF6347;
            --secondary-color: #8BC34A;
            --accent-color: #FFA726;
            --dark-color: #6D4C41;
            --light-color: #FFF8E1;
        }

        /* Container Styling */
        .container.mt-5 {
            padding: 2rem;
            background-color: var(--light-color);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Heading Styling */
        .display-4 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        /* Paragraph Styling */
        .lead.text-muted {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.2rem;
            color: var(--dark-color);
            text-align: center;
            margin-top: 1rem;
        }

        /* Alert Styling */
        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            color: var(--light-color);
        }

        .alert-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: var(--light-color);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: var(--light-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-body h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .card-body h5 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .card-body p {
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .card-body .font-weight-bold {
            font-weight: 600;
            color: var(--dark-color);
        }

        /* Button Styling */
        .btn-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: var(--light-color);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .display-4 {
                font-size: 2rem;
            }

            .card-body h4 {
                font-size: 1.25rem;
            }

            .card-body h5 {
                font-size: 1rem;
            }

            .card-body p {
                font-size: 0.9rem;
            }

            .btn-danger {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }
    </style>

    <div class="container mt-5">
        <h1 class="display-4">Manage Recipes</h1>
        <h2>Total Recipes: {{ $totalRecipes }}</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($recipes->isEmpty())
            <p class="lead text-muted">No recipes found.</p>
        @endif

        @foreach($recipes as $recipe)
            <div class="card mb-4 shadow-lg">
                <div class="card-body">
                    <h4 class="text-primary">Recipe Title:</h4>
                    <p class="font-weight-bold" style="font-size: 1.5rem;">{{ $recipe->title }}</p>

                    <h5 class="text-secondary">Description:</h5>
                    <p>{{ $recipe->description ?? 'No description available.' }}</p>

                    <h5 class="text-info">Recipe Owner: 
                        <span class="font-weight-bold">
                            {{ $recipe->user->name ?? 'Unknown User' }}
                        </span>
                    </h5>

                    <form action="{{ route('admin.recipes.delete', $recipe->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg mt-3">Delete Recipe</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
