
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
        h1 {
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
            margin-bottom: 1.5rem;
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
            background: var(--light-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 2rem;
        }

        /* Form Styling */
        .form-group label {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid var(--primary-color);
            border-radius: 10px;
            padding: 0.8rem;
            font-family: 'Open Sans', sans-serif;
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

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            h3 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .form-control {
                padding: 0.6rem;
            }

            .btn-primary {
                padding: 0.6rem 1.2rem;
            }
        }
    </style>

    <div class="container mt-5">
        <h1>Edit User</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <h3>Update User Info</h3>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="role">Role:</label>
                        <select name="role" id="role" class="form-control">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <input type="hidden" name="is_admin" id="is_admin" value="{{ $user->role == 'admin' ? '1' : '0' }}">

                    <button type="submit" class="btn btn-primary mt-3">Update User</button>
                </form>
            </div>
        </div>
    </div>
@endsection



