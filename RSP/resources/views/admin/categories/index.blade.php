{{-- <h1>Manage Categories</h1>

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit">Create Category</button>
</form>

@foreach($categories as $category)
    <div>{{ $category->name }}
        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach --}}


{{-- @extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Manage Categories</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Category Form -->
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="categoryName" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>

        <hr>

        <h3>Existing Categories</h3>
        <ul class="list-group mt-3">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $category->name }}
                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection --}}

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
        h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 2rem;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            color: var(--primary-color);
            margin: 2rem 0 1.5rem;
        }

        /* Alert Styling */
        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-danger {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: var(--light-color);
        }

        .alert-success {
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            color: var(--light-color);
        }

        /* Form Styling */
        .form-label {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            color: var(--dark-color);
        }

        .form-control {
            border: 2px solid var(--primary-color);
            border-radius: 10px;
            padding: 0.8rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 10px rgba(255, 99, 71, 0.2);
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: var(--light-color);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* List Styling */
        .list-group {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            background-color: var(--light-color);
            border: 2px solid var(--primary-color);
            padding: 1.2rem;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            transform: translateX(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Delete Button */
        .btn-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: var(--light-color);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h2 {
                font-size: 2rem;
            }

            h3 {
                font-size: 1.5rem;
            }

            .list-group-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .btn-danger {
                width: 100%;
            }
        }
    </style>

    <div class="container mt-5">
        <h2>Manage Categories</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="categoryName" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>

        <hr>

        <h3>Existing Categories</h3>
        <ul class="list-group mt-3">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $category->name }}
                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

