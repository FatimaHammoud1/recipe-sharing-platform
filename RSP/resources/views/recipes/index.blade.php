

     @extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')
    <style>
       
      



         /* Admin & Create Buttons Container */
    .top-buttons {
        display: flex;
        justify-content: flex-end; /* Align buttons to the right */
        gap: 15px;
        margin-bottom: 20px;
    }


    /* General Button Styling */
    .btn-custom {
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: bold;
        color: white;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: inline-block;
    }

    .btn-custom:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Specific Button Colors */
    .btn-dashboard {
        background-color: var(--dark-color);
    }

    .btn-create {
        background-color: var(--dark-color);
    }

        .container.mt-4 {
            background: linear-gradient(45deg, var(--light-color) 0%, #ffffff 100%);
            padding: 2rem;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        h1 {
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            position: relative;
            display: inline-block;
            font-family: 'Pacifico', cursive;
        }

        h1:before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
        }

        .recipe-card {
            border: 2px solid var(--primary-color);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(45deg, var(--light-color) 0%, #ffffff 100%);
        }

        .recipe-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(255,107,107,0.2);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        .average-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--secondary-color);
            padding: 8px 10px;
            border-radius: 25px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .action-buttons .btn {
            border-radius: 15px;
            padding: 8px 20px;
            margin: 5px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .floating-ingredients span {
            position: absolute;
            font-size: 2.5rem;
            opacity: 0.7;
            animation: float 6s infinite linear;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }


        .dancing-script{
            font-family: "Dancing Script", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
}



    

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg) scale(1); }
            50% { transform: translateY(50vh) rotate(180deg) scale(1.2); }
            100% { transform: translateY(-100vh) rotate(360deg) scale(1); }
        }


        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .btn-primary { background-color: var(--primary-color); }
        .btn-info { background-color: var(--accent-color); }
        .btn-warning { background-color: var(--secondary-color); }

        

    
    </style>


    <!-- Animated Elements -->
    <div class="floating-ingredients">
        <span style="left: 5%">🍅</span>
        <span style="left: 15%">🧄</span>
        <span style="left: 85%">🌶️</span>
        <span style="left: 95%">🥑</span>
    </div>

    

    <!-- Main Content -->
    
        <div class="row">
            <h1 class="col-12 mb-2" class="dancing-script">Hello Food Lovers 👋🍳</h1>

         
            <div class="top-buttons">
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-custom btn-dashboard">
                        📊 Admin Dashboard
                    </a>
                @endif
                
                    <a href="{{ route('recipes.create') }}" class="btn btn-custom btn-create">
                        ➕ Create Recipe
                    </a>
               
            </div>

            <form action="{{ route('recipes.index') }}" method="GET" class="col-12 mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="🔍 Search by Recipe Title" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>

         

            @if(session('success'))
                <div class="alert alert-success col-12">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger col-12">
                    {{ session('error') }}
                </div>
            @endif

            @foreach ($recipes as $recipe)
                <div class="col-md-4 mb-4">
                    <div class="card recipe-card shadow-sm">
                        @if ($recipe->image)
                            <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->name }}">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image">
                        @endif

                        <div class="average-rating">
                            <p>⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</p>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="action-buttons">
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>

                                @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this recipe?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dynamic floating ingredients
        function createFloatingIngredient() {
            const ingredients = ['🍅','🧄','🥕','🌶️','🥑','🍄','🥦','🧀'];
            const elem = document.createElement('span');
            elem.textContent = ingredients[Math.floor(Math.random()*ingredients.length)];
            elem.style.left = Math.random()*95 + '%';
            elem.style.animationDelay = Math.random()*5 + 's';
            document.querySelector('.floating-ingredients').appendChild(elem);
            setTimeout(() => elem.remove(), 6000);
        }
        setInterval(createFloatingIngredient, 1500);
    </script>
@endpush
@endsection


{{-- @extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')
    <style>
        .container.mt-4 {
            background: linear-gradient(45deg, var(--light-color) 0%, #ffffff 100%);
            padding: 2rem;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            
        }

        h1 {
            color: var(--dark-color) ;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            position: relative;
            display: inline-block;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
        }

        .recipe-card {
            border: 2px solid var(--primary-color);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(45deg, var(--light-color) 0%, #ffffff 100%);
        }

        .recipe-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(255,107,107,0.2);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        .average-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--secondary-color);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .action-buttons .btn {
            border-radius: 15px;
            padding: 8px 20px;
            margin: 5px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .floating-ingredients span {
            position: absolute;
            font-size: 2.5rem;
            opacity: 0.7;
            animation: float 6s infinite linear;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg) scale(1); }
            50% { transform: translateY(50vh) rotate(180deg) scale(1.2); }
            100% { transform: translateY(-100vh) rotate(360deg) scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .btn-primary { background-color: var(--primary-color); }
        .btn-info { background-color: var(--accent-color); }
        .btn-warning { background-color: var(--secondary-color); }
    </style>

    <!-- Animated Elements -->
    <div class="floating-ingredients">
        <span style="left: 5%">🍅</span>
        <span style="left: 15%">🧄</span>
        <span style="left: 85%">🌶️</span>
        <span style="left: 95%">🥑</span>
    </div>

    <!-- Main Content -->
    {{-- <div class="container mt-4"> --}}
        {{-- <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4" >Hello To The Shared Spoon</h1>
            </div>
            @if(Auth::user() && Auth::user()->role == 'admin')
                <div class="col-md-4 text-end mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                    </a>
                </div>
            @endif

            <form action="{{ route('recipes.index') }}" method="GET" class="col-12 mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="🔍 Search by Recipe Title" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>

            <div class="col-12 mb-4">
                <a href="{{ route('recipes.create') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus-circle"></i> Create New Recipe
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success col-12">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger col-12">
                    {{ session('error') }}
                </div>
            @endif

            @foreach ($recipes as $recipe)
                <div class="col-md-4 mb-4">
                    <div class="card recipe-card shadow-sm">
                        @if ($recipe->image)
                            <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->name }}">
                        @else
                            <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image">
                        @endif

                        <div class="average-rating">
                            <p>⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</p>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $recipe->title }}</h5>
                            <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="action-buttons">
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>

                                @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this recipe?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    {{-- </div> --}}

{{-- @push('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dynamic floating ingredients
        function createFloatingIngredient() {
            const ingredients = ['🍅','🧄','🥕','🌶️','🥑','🍄','🥦','🧀'];
            const elem = document.createElement('span');
            elem.textContent = ingredients[Math.floor(Math.random()*ingredients.length)];
            elem.style.left = Math.random()*95 + '%';
            elem.style.animationDelay = Math.random()*5 + 's';
            document.querySelector('.floating-ingredients').appendChild(elem);
            setTimeout(() => elem.remove(), 6000);
        }
        setInterval(createFloatingIngredient, 1500);
    </script>
@endpush
@endsection --}} 

{{-- @extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')
    <style>
        /* Add floating home button */
        .home-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            animation: float 3s ease-in-out infinite;
        }

        .container.mt-4 {
            background: linear-gradient(45deg, var(--light-color) 0%, #ffffff 100%);
            padding: 2rem;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            position: relative;
            z-index: 1;
        }

        h1 {
            color: var(--dark-color);
            font-family: 'Playfair Display', serif;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            position: relative;
            display: inline-block;
            animation: fadeInUp 1s ease;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
            animation: widthGrow 1s ease;
        }

        .recipe-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: linear-gradient(45deg, var(--light-color) 0%, #ffffff 100%);
            box-shadow: 0 4px 20px rgba(109, 76, 65, 0.1);
        }

        .recipe-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(255,107,107,0.2);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        .average-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            color: white;
        }

        .action-buttons .btn {
            border-radius: 15px;
            padding: 8px 20px;
            margin: 5px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-buttons .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        .floating-ingredients span {
            position: fixed;
            font-size: 2.5rem;
            opacity: 0.7;
            animation: float 6s infinite linear;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg) scale(1); }
            50% { transform: translateY(50vh) rotate(180deg) scale(1.2); }
            100% { transform: translateY(-100vh) rotate(360deg) scale(1); }
        }

        @keyframes widthGrow {
            from { width: 0; }
            to { width: 60px; }
        }

        .btn-primary { 
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
        }

        .btn-info { 
            background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
            color: white;
        }

        .btn-warning { 
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            color: white;
        }
    </style>

    <!-- Floating Home Button -->
    <button class="home-btn" onclick="window.location.href='{{ route('recipes.index') }}'">
        🏠 Home <i class="ms-2 fas fa-chevron-left"></i>
    </button>

    <!-- Animated Elements -->
    <div class="floating-ingredients">
        <span style="left: 5%">🍅</span>
        <span style="left: 15%">🧄</span>
        <span style="left: 85%">🌶️</span>
        <span style="left: 95%">🥑</span>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="mb-4" >Hello To The Shared Spoon</h1>
                </div>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div class="col-md-4 text-end mb-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                        </a>
                    </div>
                @endif
    
                <form action="{{ route('recipes.index') }}" method="GET" class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="🔍 Search by Recipe Title" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>
    
                <div class="col-12 mb-4">
                    <a href="{{ route('recipes.create') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-plus-circle"></i> Create New Recipe
                    </a>
                </div>
    
                @if(session('success'))
                    <div class="alert alert-success col-12">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger col-12">
                        {{ session('error') }}
                    </div>
                @endif
    
                @foreach ($recipes as $recipe)
                    <div class="col-md-4 mb-4">
                        <div class="card recipe-card shadow-sm">
                            @if ($recipe->image)
                                <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->name }}">
                            @else
                                <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image">
                            @endif
    
                            <div class="average-rating">
                                <p>⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</p>
                            </div>
    
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                                <div class="action-buttons">
                                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
    
                                    @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
    
                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this recipe?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@push('script')
    <script>
        // Enhanced floating ingredients
        function createFloatingIngredient() {
            const ingredients = ['🍅','🧄','🥕','🌶️','🥑','🍄','🥦','🧀'];
            const elem = document.createElement('span');
            elem.textContent = ingredients[Math.floor(Math.random()*ingredients.length)];
            elem.style.left = Math.random()*95 + '%';
            elem.style.animation = `float ${6 + Math.random()*4}s infinite linear`;
            elem.style.fontSize = `${2 + Math.random()*2}rem`;
            document.querySelector('.floating-ingredients').appendChild(elem);
            setTimeout(() => elem.remove(), 6000);
        }
        setInterval(createFloatingIngredient, 1500);
    </script>
@endpush
@endsection --}}

{{-- 
@extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')
    <style>
        /* Floating home button with a modern twist */
        .home-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            animation: float 3s ease-in-out infinite;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .home-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Main container with a modern glassmorphism effect */
        .container.mt-4 {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Modern heading with a subtle underline animation */
        h1 {
            color: var(--dark-color);
            font-family: 'Playfair Display', serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            display: inline-block;
            animation: fadeInUp 1s ease;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
            animation: widthGrow 1s ease;
        }

        /* Recipe cards with a modern hover effect */
        .recipe-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .recipe-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.2);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        /* Average rating badge with a modern gradient */
        .average-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            color: white;
        }

        /* Action buttons with a modern shine effect */
        .action-buttons .btn {
            border-radius: 15px;
            padding: 8px 20px;
            margin: 5px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-buttons .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        /* Floating ingredients with a modern twist */
        .floating-ingredients span {
            position: fixed;
            font-size: 2.5rem;
            opacity: 0.7;
            animation: float 6s infinite linear;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg) scale(1); }
            50% { transform: translateY(50vh) rotate(180deg) scale(1.2); }
            100% { transform: translateY(-100vh) rotate(360deg) scale(1); }
        }

        @keyframes widthGrow {
            from { width: 0; }
            to { width: 60px; }
        }

        /* Modern button gradients */
        .btn-primary { 
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
        }

        .btn-info { 
            background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
            color: white;
        }

        .btn-warning { 
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            color: white;
        }

        /* Modern form styling */
        .form-control {
            border-radius: 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Modern alert styling */
        .alert {
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(45deg, #4CAF50, #81C784);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: white;
        }
    </style>

    <!-- Floating Home Button -->
    <button class="home-btn" onclick="window.location.href='{{ route('recipes.index') }}'">
        🏠 Home <i class="ms-2 fas fa-chevron-left"></i>
    </button>

    <!-- Animated Elements -->
    <div class="floating-ingredients">
        <span style="left: 5%">🍅</span>
        <span style="left: 15%">🧄</span>
        <span style="left: 85%">🌶️</span>
        <span style="left: 95%">🥑</span>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="mb-4">Hello To The Shared Spoon</h1>
                </div>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div class="col-md-4 text-end mb-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                        </a>
                    </div>
                @endif
    
                <form action="{{ route('recipes.index') }}" method="GET" class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="🔍 Search by Recipe Title" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>
    
                <div class="col-12 mb-4">
                    <a href="{{ route('recipes.create') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-plus-circle"></i> Create New Recipe
                    </a>
                </div>
    
                @if(session('success'))
                    <div class="alert alert-success col-12">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger col-12">
                        {{ session('error') }}
                    </div>
                @endif
    
                @foreach ($recipes as $recipe)
                    <div class="col-md-4 mb-4">
                        <div class="card recipe-card shadow-sm">
                            @if ($recipe->image)
                                <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->name }}">
                            @else
                                <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image">
                            @endif
    
                            <div class="average-rating">
                                <p>⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</p>
                            </div>
    
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                                <div class="action-buttons">
                                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
    
                                    @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
    
                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this recipe?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@push('script')
    <script>
        // Enhanced floating ingredients
        function createFloatingIngredient() {
            const ingredients = ['🍅','🧄','🥕','🌶️','🥑','🍄','🥦','🧀'];
            const elem = document.createElement('span');
            elem.textContent = ingredients[Math.floor(Math.random()*ingredients.length)];
            elem.style.left = Math.random()*95 + '%';
            elem.style.animation = `float ${6 + Math.random()*4}s infinite linear`;
            elem.style.fontSize = `${2 + Math.random()*2}rem`;
            document.querySelector('.floating-ingredients').appendChild(elem);
            setTimeout(() => elem.remove(), 6000);
        }
        setInterval(createFloatingIngredient, 1500);
    </script>
@endpush
@endsection --}}


{{-- @extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')
    <style>
        /* Floating home button with a modern twist */
        .home-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            animation: float 3s ease-in-out infinite;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .home-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Main container with a modern glassmorphism effect */
        .container.mt-4 {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Modern heading with a subtle underline animation */
        h1 {
            color: var(--dark-color);
            font-family: 'Playfair Display', serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            display: inline-block;
            animation: fadeInUp 1s ease;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
            animation: widthGrow 1s ease;
        }

        /* Recipe cards with a modern hover effect */
        .recipe-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .recipe-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.2);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        /* Average rating badge with a modern gradient */
        .average-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            color: white;
        }

        /* Action buttons with a modern shine effect */
        .action-buttons .btn {
            border-radius: 15px;
            padding: 8px 20px;
            margin: 5px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-buttons .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        /* Floating ingredients with a modern twist */
        .floating-ingredients span {
            position: fixed;
            font-size: 2.5rem;
            opacity: 0.7;
            animation: float 6s infinite linear;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg) scale(1); }
            50% { transform: translateY(50vh) rotate(180deg) scale(1.2); }
            100% { transform: translateY(-100vh) rotate(360deg) scale(1); }
        }

        @keyframes widthGrow {
            from { width: 0; }
            to { width: 60px; }
        }

        /* Modern button gradients */
        .btn-primary { 
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
        }

        .btn-info { 
            background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
            color: white;
        }

        .btn-warning { 
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            color: white;
        }

        /* Modern form styling */
        .form-control {
            border-radius: 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Modern alert styling */
        .alert {
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(45deg, #4CAF50, #81C784);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: white;
        }
    </style>

    <!-- Floating Home Button -->
    <button class="home-btn" onclick="window.location.href='{{ route('recipes.index') }}'">
        🏠 Home <i class="ms-2 fas fa-chevron-left"></i>
    </button>

    <!-- Animated Elements -->
    <div class="floating-ingredients">
        <span style="left: 5%">🍅</span>
        <span style="left: 15%">🧄</span>
        <span style="left: 85%">🌶️</span>
        <span style="left: 95%">🥑</span>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="mb-4">Hello To The Shared Spoon</h1>
                </div>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div class="col-md-4 text-end mb-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                        </a>
                    </div>
                @endif
    
                <form action="{{ route('recipes.index') }}" method="GET" class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="🔍 Search by Recipe Title" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>
    
                <div class="col-12 mb-4">
                    <a href="{{ route('recipes.create') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-plus-circle"></i> Create New Recipe
                    </a>
                </div>
    
                @if(session('success'))
                    <div class="alert alert-success col-12">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger col-12">
                        {{ session('error') }}
                    </div>
                @endif
    
                @foreach ($recipes as $recipe)
                    <div class="col-md-4 mb-4">
                        <div class="card recipe-card shadow-sm">
                            @if ($recipe->image)
                                <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->name }}">
                            @else
                                <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image">
                            @endif
    
                            <div class="average-rating">
                                <p>⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</p>
                            </div>
    
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                                <div class="action-buttons">
                                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
    
                                    @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
    
                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this recipe?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@push('script')
    <script>
        // Enhanced floating ingredients
        function createFloatingIngredient() {
            const ingredients = ['🍅','🧄','🥕','🌶️','🥑','🍄','🥦','🧀'];
            const elem = document.createElement('span');
            elem.textContent = ingredients[Math.floor(Math.random()*ingredients.length)];
            elem.style.left = Math.random()*95 + '%';
            elem.style.animation = `float ${6 + Math.random()*4}s infinite linear`;
            elem.style.fontSize = `${2 + Math.random()*2}rem`;
            document.querySelector('.floating-ingredients').appendChild(elem);
            setTimeout(() => elem.remove(), 6000);
        }
        setInterval(createFloatingIngredient, 1500);
    </script>
@endpush
@endsection --}}

{{-- @extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')
    <style>
        /* Floating home button with a modern twist */
        .home-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            animation: float 3s ease-in-out infinite;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .home-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Main container with a modern glassmorphism effect */
        .container.mt-4 {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Modern heading with a subtle underline animation */
        h1 {
            color: var(--dark-color);
            font-family: 'Playfair Display', serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            display: inline-block;
            animation: fadeInUp 1s ease;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
            animation: widthGrow 1s ease;
        }

        /* Recipe cards with a modern hover effect */
        .recipe-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .recipe-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.2);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        /* Average rating badge with a modern gradient */
        .average-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            color: white;
        }

        /* Action buttons with a modern shine effect */
        .action-buttons .btn {
            border-radius: 15px;
            padding: 8px 20px;
            margin: 5px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-buttons .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        /* Floating ingredients with a modern twist */
        .floating-ingredients span {
            position: fixed;
            font-size: 2.5rem;
            opacity: 0.7;
            animation: float 6s infinite linear;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg) scale(1); }
            50% { transform: translateY(50vh) rotate(180deg) scale(1.2); }
            100% { transform: translateY(-100vh) rotate(360deg) scale(1); }
        }

        @keyframes widthGrow {
            from { width: 0; }
            to { width: 60px; }
        }

        /* Modern button gradients */
        .btn-primary { 
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
        }

        .btn-info { 
            background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
            color: white;
        }

        .btn-warning { 
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            color: white;
        }

        /* Modern form styling */
        .form-control {
            border-radius: 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Modern alert styling */
        .alert {
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(45deg, #4CAF50, #81C784);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: white;
        }
    </style>

    <!-- Floating Home Button -->
    <button class="home-btn" onclick="window.location.href='{{ route('recipes.index') }}'">
        🏠 Home <i class="ms-2 fas fa-chevron-left"></i>
    </button>

    <!-- Animated Elements -->
    <div class="floating-ingredients">
        <span style="left: 5%">🍅</span>
        <span style="left: 15%">🧄</span>
        <span style="left: 85%">🌶️</span>
        <span style="left: 95%">🥑</span>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="mb-4">Hello To The Shared Spoon</h1>
                </div>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div class="col-md-4 text-end mb-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                        </a>
                    </div>
                @endif
    
                <form action="{{ route('recipes.index') }}" method="GET" class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="🔍 Search by Recipe Title" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>
    
                <div class="col-12 mb-4">
                    <a href="{{ route('recipes.create') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-plus-circle"></i> Create New Recipe
                    </a>
                </div>
    
                @if(session('success'))
                    <div class="alert alert-success col-12">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger col-12">
                        {{ session('error') }}
                    </div>
                @endif
    
                @foreach ($recipes as $recipe)
                    <div class="col-md-4 mb-4">
                        <div class="card recipe-card shadow-sm">
                            @if ($recipe->image)
                                <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->name }}">
                            @else
                                <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image">
                            @endif
    
                            <div class="average-rating">
                                <p>⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</p>
                            </div>
    
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                                <div class="action-buttons">
                                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
    
                                    @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
    
                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this recipe?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@push('script')
    <script>
        // Enhanced floating ingredients
        function createFloatingIngredient() {
            const ingredients = ['🍅','🧄','🥕','🌶️','🥑','🍄','🥦','🧀'];
            const elem = document.createElement('span');
            elem.textContent = ingredients[Math.floor(Math.random()*ingredients.length)];
            elem.style.left = Math.random()*95 + '%';
            elem.style.animation = `float ${6 + Math.random()*4}s infinite linear`;
            elem.style.fontSize = `${2 + Math.random()*2}rem`;
            document.querySelector('.floating-ingredients').appendChild(elem);
            setTimeout(() => elem.remove(), 6000);
        }
        setInterval(createFloatingIngredient, 1500);
    </script>
@endpush
@endsection --}}




{{-- @extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')
    <style>
        :root {
            --primary-color: #FF6347;
            --secondary-color: #8BC34A;
            --accent-color: #FFA726;
            --dark-color: #6D4C41;
            --light-color: #FFF8E1;
        }

        /* Floating home button */
        .home-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            animation: float 3s ease-in-out infinite;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .home-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* Main container */
        .container.mt-4 {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Heading with animation */
        h1 {
            color: var(--dark-color);
            font-family: 'Playfair Display', serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            display: inline-block;
            animation: fadeInUp 1s ease;
        }

        h1:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
            animation: widthGrow 1s ease;
        }

        /* Recipe cards */
        .recipe-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .recipe-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.2);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        /* Average rating badge */
        .average-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 700;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            color: white;
        }

        /* Action buttons */
        .action-buttons .btn {
            border-radius: 15px;
            padding: 8px 20px;
            margin: 5px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .action-buttons .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        /* Floating ingredients */
        .floating-ingredients span {
            position: fixed;
            font-size: 2.5rem;
            opacity: 0.7;
            animation: float 6s infinite linear;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg) scale(1); }
            50% { transform: translateY(50vh) rotate(180deg) scale(1.2); }
            100% { transform: translateY(-100vh) rotate(360deg) scale(1); }
        }

        @keyframes widthGrow {
            from { width: 0; }
            to { width: 60px; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shine {
            0% { transform: rotate(45deg) translateX(-150%); }
            100% { transform: rotate(45deg) translateX(150%); }
        }

        /* Modern button gradients */
        .btn-primary { 
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
        }

        .btn-info { 
            background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
            color: white;
        }

        .btn-warning { 
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            color: white;
        }

        .btn-success {
            background: linear-gradient(45deg, var(--secondary-color), var(--accent-color));
            color: white;
        }

        .btn-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: white;
        }

        /* Modern form styling */
        .form-control {
            border-radius: 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Modern alert styling */
        .alert {
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(45deg, #4CAF50, #81C784);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: white;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .home-btn {
                bottom: 10px;
                left: 10px;
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .container.mt-4 {
                padding: 1rem;
            }

            h1 {
                font-size: 1.8rem;
            }

            .recipe-card {
                margin-bottom: 1rem;
            }

            .card-img-top {
                height: 200px;
            }

            .action-buttons .btn {
                padding: 6px 15px;
                font-size: 0.8rem;
            }
        }
    </style>

    <!-- Floating Home Button -->
    <button class="home-btn" onclick="window.location.href='{{ route('recipes.index') }}'">
        🏠 Home <i class="ms-2 fas fa-chevron-left"></i>
    </button>

    <!-- Animated Elements -->
    <div class="floating-ingredients">
        <span style="left: 5%">🍅</span>
        <span style="left: 15%">🧄</span>
        <span style="left: 85%">🌶️</span>
        <span style="left: 95%">🥑</span>
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="mb-4">Hello To The Shared Spoon</h1>
                </div>
                @if(Auth::user() && Auth::user()->role == 'admin')
                    <div class="col-md-4 text-end mb-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                        </a>
                    </div>
                @endif
    
                <form action="{{ route('recipes.index') }}" method="GET" class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control" placeholder="🔍 Search by Recipe Title" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>
    
                <div class="col-12 mb-4">
                    <a href="{{ route('recipes.create') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-plus-circle"></i> Create New Recipe
                    </a>
                </div>
    
                @if(session('success'))
                    <div class="alert alert-success col-12">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger col-12">
                        {{ session('error') }}
                    </div>
                @endif
    
                @foreach ($recipes as $recipe)
                    <div class="col-md-4 mb-4">
                        <div class="card recipe-card shadow-sm">
                            @if ($recipe->image)
                                <img src="{{ $recipe->image }}" class="card-img-top" alt="{{ $recipe->name }}">
                            @else
                                <img src="{{ asset('default-image.jpg') }}" class="card-img-top" alt="Default Image">
                            @endif
    
                            <div class="average-rating">
                                <p>⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</p>
                            </div>
    
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                                <div class="action-buttons">
                                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
    
                                    @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
    
                                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this recipe?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('script')
        <script>
            // Enhanced floating ingredients
            function createFloatingIngredient() {
                const ingredients = ['🍅','🧄','🥕','🌶️','🥑','🍄','🥦','🧀'];
                const elem = document.createElement('span');
                elem.textContent = ingredients[Math.floor(Math.random()*ingredients.length)];
                elem.style.left = Math.random()*95 + '%';
                elem.style.animation = `float ${6 + Math.random()*4}s infinite linear`;
                elem.style.fontSize = `${2 + Math.random()*2}rem`;
                document.querySelector('.floating-ingredients').appendChild(elem);
                setTimeout(() => elem.remove(), 6000);
            }
            setInterval(createFloatingIngredient, 1500);
        </script>
    @endpush
@endsection --}}

{{-- 
@extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')

    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --accent-color: #FF9F43;
            --light-color: #F8F9FA;
            --dark-color: #2C3E50;
        }

        /* Floating Home Button */
        .home-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
            font-weight: 600;
            border: none;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .home-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        /* Container Styling */
        .container.mt-4 {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            position: relative;
            z-index: 1;
        }

        /* Title Styling */
        h1 {
            color: var(--dark-color);
            font-family: 'Playfair Display', serif;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            font-size: 2.5rem;
            position: relative;
            display: inline-block;
            animation: fadeInUp 1s ease;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
        }

        /* Recipe Card Styling */
        .recipe-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .recipe-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        /* Ratings Badge */
        .average-rating {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--secondary-color);
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: bold;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Button Styles */
        .action-buttons .btn {
            border-radius: 12px;
            padding: 10px 15px;
            margin: 5px;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
            border: none;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .btn-info {
            background: var(--accent-color);
            color: white;
            border: none;
        }

        .btn-warning {
            background: var(--secondary-color);
            color: white;
            border: none;
        }

        /* Floating Ingredients */
        .floating-ingredients span {
            position: fixed;
            font-size: 2.5rem;
            opacity: 0.6;
            animation: float 8s infinite ease-in-out;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0.8; }
            50% { transform: translateY(50vh) rotate(180deg); opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0.8; }
        }
    </style>

    <!-- Floating Home Button -->
    <button class="home-btn" onclick="window.location.href='{{ route('home') }}'">
        🏠 Home <i class="ms-2 fas fa-chevron-left"></i>
    </button>

    <!-- Floating Ingredients -->
    <div class="floating-ingredients">
        <span style="left: 5%">🍅</span>
        <span style="left: 15%">🧄</span>
        <span style="left: 85%">🌶️</span>
        <span style="left: 95%">🥑</span>
    </div>

    <!-- Main Content -->
    
        <h1 class="mb-4">Hello To The Shared Spoon</h1>

        <!-- Search & Filter -->
        <form action="{{ route('recipes.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Search recipes..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-control">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>

        @foreach ($recipes as $recipe)
            <div class="col-md-4 mb-4">
                <div class="card recipe-card">
                    <img src="{{ $recipe->image ?: asset('default-image.jpg') }}" class="card-img-top" alt="{{ $recipe->title }}">
                    <div class="average-rating">⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->title }}</h5>
                        <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                        <div class="action-buttons">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">View</a>
                            @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    
@endsection --}}
{{-- 
@extends('layout.app')

@section('title')
    Recipes Page
@endsection

@section('content')

<style>
    :root {
        --primary-color: #FF6B6B;
        --secondary-color: #4ECDC4;
        --accent-color: #FF9F43;
        --light-color: #F8F9FA;
        --dark-color: #2C3E50;
    }

    /* Floating Home Button */
    .home-btn {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 1000;
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
        color: white;
        font-weight: 600;
        border: none;
        cursor: pointer;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .home-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    /* Title Styling */
    h1 {
        color: var(--dark-color);
        font-family: 'Playfair Display', serif;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        font-size: 2.5rem;
        position: relative;
        display: inline-block;
        animation: fadeInUp 1s ease;
    }

    h1::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 80px;
        height: 4px;
        background: var(--secondary-color);
        border-radius: 2px;
    }

    /* Recipe Container - Inline Cards */
    .recipe-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    /* Recipe Card */
    .recipe-card {
        width: 280px;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .recipe-card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-bottom: 3px solid var(--primary-color);
    }

    /* Ratings Badge */
    .average-rating {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--secondary-color);
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: bold;
        color: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    /* Buttons */
    .action-buttons .btn {
        border-radius: 12px;
        padding: 8px 12px;
        margin: 3px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
        color: white;
        border: none;
    }

    .btn-primary:hover {
        opacity: 0.9;
    }

    .btn-info {
        background: var(--accent-color);
        color: white;
        border: none;
    }

    .btn-warning {
        background: var(--secondary-color);
        color: white;
        border: none;
    }

    /* Floating Ingredients */
    .floating-ingredients span {
        position: fixed;
        font-size: 2.5rem;
        opacity: 0.6;
        animation: float 8s infinite ease-in-out;
        pointer-events: none;
        z-index: 0;
    }

    @keyframes float {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0.8; }
        50% { transform: translateY(50vh) rotate(180deg); opacity: 1; }
        100% { transform: translateY(-100vh) rotate(360deg); opacity: 0.8; }
    }
</style>

<!-- Floating Home Button -->
<button class="home-btn" onclick="window.location.href='{{ route('home') }}'">
    🏠 Home <i class="ms-2 fas fa-chevron-left"></i>
</button>

<!-- Floating Ingredients -->
<div class="floating-ingredients">
    <span style="left: 5%">🍅</span>
    <span style="left: 15%">🧄</span>
    <span style="left: 85%">🌶️</span>
    <span style="left: 95%">🥑</span>
</div>

<!-- Main Content -->
<div class="container mt-4">
    <h1 class="mb-4 text-center">Hello To The Shared Spoon</h1>

    <!-- Search & Filter -->
    <form action="{{ route('recipes.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="🔍 Search recipes..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <!-- Recipe Cards Displayed Inline -->
    <div class="recipe-container">
        @foreach ($recipes as $recipe)
            <div class="recipe-card">
                <img src="{{ $recipe->image ?: asset('default-image.jpg') }}" class="card-img-top" alt="{{ $recipe->title }}">
                <div class="average-rating">⭐ {{ number_format($recipe->ratings_avg_rating, 1) }}/5</div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $recipe->title }}</h5>
                    <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                    <div class="action-buttons">
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">View</a>
                        @if(Auth::check() && (Auth::id() == $recipe->user_id || Auth::user()->role == 'admin'))
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection --}}








