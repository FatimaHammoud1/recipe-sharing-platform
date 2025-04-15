
@extends('layouts.admin')

@section('content')
    
    <style>
      
        /* Admin Content Styling */
        .admin-content {
            padding: 2rem;
            background-color: var(--light-color);
            min-height: 100vh;
        }
    
        .admin-content h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 2rem;
            text-align: center;
            animation: fadeIn 1s ease;
        }
    
        /* Dashboard Cards Container */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
        }
    
        /* Individual Dashboard Card Styling */
        .dashboard-card {
            background: var(--light-color);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: slideUp 0.5s ease;
        }
    
        .dashboard-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: var(--light-color);
        }
    
        .dashboard-card:hover h3,
        .dashboard-card:hover p {
            color: var(--light-color);
        }
    
        .dashboard-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
    
        .dashboard-card p {
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            color: var(--dark-color);
        }
    
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    
        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-content h2 {
                font-size: 2rem;
            }
    
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
    
            .dashboard-card {
                padding: 1rem;
            }
    
            .dashboard-card h3 {
                font-size: 1.25rem;
            }
    
            .dashboard-card p {
                font-size: 0.9rem;
            }
        }
    </style>

    <div class="admin-content">
        <h2>Welcome to Admin Dashboard</h2>

        <div class="dashboard-cards">
            <a href="{{ route('admin.recipes.index') }}" class="dashboard-card">
                <h3>📋 Recipes</h3>
                <p>Manage all the recipes easily in one place</p>
            </a>

            <a href="{{ route('admin.users.index') }}" class="dashboard-card">
                <h3>👥 Users</h3>
                <p>Monitor and control user activities</p>
            </a>

            <a href="{{ route('admin.comments.index') }}" class="dashboard-card">
                <h3>💬 Comments</h3>
                <p>Review and moderate user comments</p>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="dashboard-card">
                <h3>🗂️ Categories</h3>
                <p>Organize recipe categories</p>
            </a>
        </div>
    </div>
@endsection
 

