
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

        /* Heading Styling */
        h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--light-color);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: var(--light-color);
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            font-family: 'Open Sans', sans-serif;
        }

        .table th {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .table td {
            font-size: 1rem;
            color: var(--dark-color);
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Button Styling */
        .btn-warning {
            background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
            color: var(--light-color);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-danger {
            background: linear-gradient(45deg, #F44336, #E57373);
            color: var(--light-color);
            border: none;
            padding: 0.5rem 1rem;
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
            h2 {
                font-size: 2rem;
            }

            .table th,
            .table td {
                padding: 0.8rem;
                font-size: 0.9rem;
            }

            .btn-warning,
            .btn-danger {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }
        }
    </style>

    <h2>Manage Users</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete User Form -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
