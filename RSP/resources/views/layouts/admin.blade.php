{{-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="admin-header">
<h1>Admin Dashboard</h1>
<ul>
<li><a href="{{ route('recipes.index') }}">Dashboard</a></li>
<li><a href="{{ route('admin.recipes.index') }}">Manage Recipes</a></li>
<li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
</ul>
</div>
<div class="admin-content">
@yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html> --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Optional: Add Bootstrap for better navbar styling -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recipes.index') }}">Shared Spoon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.recipes.index') }}">Manage Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Manage Users</a>
                    </li>

                    <li class='nav-item'><a class='nav-link' href="{{ route('admin.comments.index') }}">Manage Comments</a></li>
                    <li class = "nav-item"><a class='nav-link' href="{{ route('admin.categories.index') }}">Manage Categories</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="admin-content container mt-4">
        @yield('content')
    </div>

    <!-- Optional: Add Bootstrap JS for responsive features -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html> --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #f81717;
            --secondary-color: #05887f;
            --accent-color: #FFE66D;
            --dark-color: #2D3047;
            --light-color: #F7FFF7;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
        }

        .navbar {
            background-color: var(--dark-color) !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: var(--light-color) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .admin-content {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-top: 2rem;
            min-height: 70vh;
        }

        .navbar-toggler {
            border-color: var(--primary-color);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23FF6B6B' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('recipes.index') ? 'active' : '' }}" 
                           href="{{ route('recipes.index') }}">Shared Spoon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.recipes.*') ? 'active' : '' }}" 
                           href="{{ route('admin.recipes.index') }}">Manage Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.users.*') ? 'active' : '' }}" 
                           href="{{ route('admin.users.index') }}">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.comments.*') ? 'active' : '' }}" 
                           href="{{ route('admin.comments.index') }}">Manage Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.categories.*') ? 'active' : '' }}" 
                           href="{{ route('admin.categories.index') }}">Manage Categories</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="admin-content container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class animation
        document.querySelectorAll('.nav-link').forEach(link => {
            if(link.classList.contains('active')) {
                link.style.borderBottom = `2px solid ${getComputedStyle(document.documentElement)
                    .getPropertyValue('--primary-color')}`;
            }
        });
    </script>
</body>
</html> --}}

{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #f81717;
            --secondary-color: #05887f;
            --accent-color: #FFE66D;
            --dark-color: #2D3047;
            --light-color: #F7FFF7;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-color);
            min-height: 100vh;
        }

        .admin-header {
            background: var(--dark-color);
            padding: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .admin-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid transparent;
            text-decoration: none !important;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255,107,107,0.1);
            border-color: var(--primary-color);
        }

        .card-title {
            color: var(--dark-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .card-icon {
            font-size: 2rem;
            color: var(--primary-color);
        }

        .admin-content {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            margin: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .floating-admin-menu {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .menu-button {
            background: var(--primary-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 8px 15px rgba(255,107,107,0.3);
            transition: all 0.3s ease;
        }

        .menu-button:hover {
            transform: scale(1.1);
            background: var(--secondary-color);
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <a href="{{ route('recipes.index') }}" class="text-decoration-none">
                <h2 style="color: white; font-family: 'Playfair Display', serif;">
                    Shared Spoon Admin
                </h2>
            </a>
        </div>
    </header>

    <main class="container">
        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <a href="{{ route('admin.recipes.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">📋</span>
                    Manage Recipes
                </div>
                <p class="text-muted">View, edit, and manage all recipes</p>
            </a>

            <a href="{{ route('admin.users.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">👥</span>
                    Manage Users
                </div>
                <p class="text-muted">Manage user accounts and permissions</p>
            </a>

            <a href="{{ route('admin.comments.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">💬</span>
                    Manage Comments
                </div>
                <p class="text-muted">Moderate and manage user comments</p>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">🗂️</span>
                    Manage Categories
                </div>
                <p class="text-muted">Organize and edit recipe categories</p>
            </a>
        </div>

        <!-- Content Section -->
        <div class="admin-content">
            @yield('content')
        </div>
    </main>

    <!-- Floating Menu -->
    <div class="floating-admin-menu">
        <div class="menu-button" data-bs-toggle="dropdown">
            ⚙️
        </div>
        <ul class="dropdown-menu dropdown-menu-end shadow-lg">
            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a class="dropdown-item" href="{{ route('recipes.index') }}">Main Site</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('admin.recipes.index') }}">Manage Recipes</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Manage Users</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.comments.index') }}">Manage Comments</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Manage Categories</a></li>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add hover effect to cards
        document.querySelectorAll('.admin-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html> --}}

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #FFA726;
            --accent-color: #4ECDC4;
            --dark-color: #2D3047;
            --light-color: #F7FFF7;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-color);
            min-height: 100vh;
        }

        .admin-header {
            background: var(--dark-color);
            padding: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .admin-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid transparent;
            text-decoration: none !important;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255,107,107,0.1);
            border-color: var(--primary-color);
        }

        .card-title {
            color: var(--dark-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .card-icon {
            font-size: 2rem;
            color: var(--primary-color);
        }

        .admin-content {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            margin: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .floating-admin-menu {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .menu-button {
            background: var(--primary-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 8px 15px rgba(255,107,107,0.3);
            transition: all 0.3s ease;
        }

        .menu-button:hover {
            transform: scale(1.1);
            background: var(--secondary-color);
        }

        /* Added Navbar Styles */
        .admin-navbar {
            background: var(--dark-color);
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .admin-navbar .nav-link {
            color: var(--light-color) !important;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .admin-navbar .nav-link:hover {
            color: var(--primary-color) !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg admin-navbar">
       
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}" 
               style="color: white !important; font-family: 'Playfair Display', serif; font-size: 2rem;">
                Admin Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recipes.index') }}">Shared Spoon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.recipes.index') }}">Manage Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.comments.index') }}">Manage Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">Manage Categories</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <a href="{{ route('admin.recipes.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">📋</span>
                    Manage Recipes
                </div>
                <p class="text-muted">View, edit, and manage all recipes</p>
            </a>

            <a href="{{ route('admin.users.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">👥</span>
                    Manage Users
                </div>
                <p class="text-muted">Manage user accounts and permissions</p>
            </a>

            <a href="{{ route('admin.comments.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">💬</span>
                    Manage Comments
                </div>
                <p class="text-muted">Moderate and manage user comments</p>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">🗂️</span>
                    Manage Categories
                </div>
                <p class="text-muted">Organize and edit recipe categories</p>
            </a>
        </div>

        <!-- Content Section -->
        <div class="admin-content">
            @yield('content')
        </div>
    </main>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add hover effect to cards
        document.querySelectorAll('.admin-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html> --}}

{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #FFA726;
            --accent-color: #4ECDC4;
            --dark-color: #2D3047;
            --light-color: #F7FFF7;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-color);
            min-height: 100vh;
        }

        .admin-navbar {
            background: var(--dark-color);
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .admin-navbar .navbar-brand {
            color: white !important;
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
        }

        .admin-navbar .nav-link {
            color: var(--light-color) !important;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .admin-navbar .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .admin-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 2px solid transparent;
            text-decoration: none !important;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255,107,107,0.1);
            border-color: var(--primary-color);
        }

        .card-title {
            color: var(--dark-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .card-icon {
            font-size: 2rem;
            color: var(--primary-color);
        }

        .admin-content {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            margin: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .floating-admin-menu {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .menu-button {
            background: var(--primary-color);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 8px 15px rgba(255,107,107,0.3);
            transition: all 0.3s ease;
        }

        .menu-button:hover {
            transform: scale(1.1);
            background: var(--secondary-color);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg admin-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                Admin Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recipes.index') }}">Shared Spoon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.recipes.index') }}">Manage Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.comments.index') }}">Manage Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">Manage Categories</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <a href="{{ route('admin.recipes.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">📋</span>
                    Manage Recipes
                </div>
                <p class="text-muted">View, edit, and manage all recipes</p>
            </a>

            <a href="{{ route('admin.users.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">👥</span>
                    Manage Users
                </div>
                <p class="text-muted">Manage user accounts and permissions</p>
            </a>

            <a href="{{ route('admin.comments.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">💬</span>
                    Manage Comments
                </div>
                <p class="text-muted">Moderate and manage user comments</p>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="admin-card">
                <div class="card-title">
                    <span class="card-icon">🗂️</span>
                    Manage Categories
                </div>
                <p class="text-muted">Organize and edit recipe categories</p>
            </a>
        </div>

        <!-- Content Section -->
        <div class="admin-content">
            @yield('content')
        </div>
    </main>

    <!-- Floating Menu -->
    <div class="floating-admin-menu">
        <div class="menu-button" data-bs-toggle="dropdown">
            ⚙️
        </div>
        <ul class="dropdown-menu dropdown-menu-end shadow-lg">
            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a class="dropdown-item" href="{{ route('recipes.index') }}">Main Site</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('admin.recipes.index') }}">Manage Recipes</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Manage Users</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.comments.index') }}">Manage Comments</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Manage Categories</a></li>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap components
            var dropdowns = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            dropdowns.forEach(function(dropdown) {
                new bootstrap.Dropdown(dropdown);
            });

            // Navbar toggle
            var navbarToggles = [].slice.call(document.querySelectorAll('[data-bs-toggle="collapse"]'));
            navbarToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    var target = document.querySelector(toggle.dataset.bsTarget);
                    new bootstrap.Collapse(target, {toggle: true});
                });
            });

            // Card hover effect
            document.querySelectorAll('.admin-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html> --}}

{{-- <html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    .admin-header {
        background-color: #ff6b6b;
        color: white;
        padding: 15px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .admin-header ul {
        list-style: none;
        padding: 0;
        margin: 10px 0 0;
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .admin-header ul li {
        display: inline;
    }

    .admin-header ul li a {
        text-decoration: none;
        color: white;
        font-weight: 500;
        transition: 0.3s;
    }

    .admin-header ul li a:hover {
        text-decoration: underline;
    }

    .admin-content {
        padding: 20px;
        text-align: center;
    }

    /* Cute Cards */
    .dashboard-cards {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .dashboard-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        width: 250px;
        transition: 0.3s;
        cursor: pointer;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .dashboard-card h3 {
        margin-bottom: 10px;
        font-size: 1.2rem;
        color: #ff6b6b;
    }

    .dashboard-card p {
        font-size: 0.9rem;
        color: #555;
    }
</style>
</head>
<body>
<div class="admin-header">
<h1>Admin Dashboard</h1>
<ul>
<li><a href="{{ route('recipes.index') }}">Dashboard</a></li>
<li><a href="{{ route('admin.recipes.index') }}">Manage Recipes</a></li>
<li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
</ul>
</div>

<div class="admin-content">
    <h2>Welcome to Admin Dashboard</h2>

    <div class="dashboard-cards">
        <div class="dashboard-card">
            <h3>Recipes</h3>
            <p>Manage all the recipes easily in one place.</p>
        </div>

        <div class="dashboard-card">
            <h3>Users</h3>
            <p>Monitor and control user activities.</p>
        </div>

        <div class="dashboard-card">
            <h3>Comments</h3>
            <p>Review and moderate user comments.</p>
        </div>

        <div class="dashboard-card">
            <h3>Settings</h3>
            <p>Customize admin settings for better control.</p>
        </div>
    </div>

    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html> --}}

{{-- <html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    .admin-header {
        background-color: #f81717;
        color: white;
        padding: 15px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .admin-header ul {
        list-style: none;
        padding: 0;
        margin: 10px 0 0;
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .admin-header ul li {
        display: inline;
    }

    .admin-header ul li a {
        text-decoration: none;
        color: white;
        font-weight: 500;
        transition: 0.3s;
        padding: 8px 15px;
        border-radius: 20px;
    }

    .admin-header ul li a:hover {
        background-color: rgba(255,255,255,0.1);
        text-decoration: none;
    }

    .admin-content {
        padding: 20px;
        text-align: center;
    }

    /* Cute Cards */
    .dashboard-cards {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .dashboard-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        width: 250px;
        transition: 0.3s;
        cursor: pointer;
        text-decoration: none !important;
        color: inherit;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .dashboard-card h3 {
        margin-bottom: 10px;
        font-size: 1.2rem;
        color: #f81717b6b;
    }

    .dashboard-card p {
        font-size: 0.9rem;
        color: #555;
    }
    .admin-home-btn {
        display: inline-block;
        margin: 15px 0;
        padding: 10px 25px;
        background-color: #f81717;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 2px solid white;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        
    }

    .admin-home-btn:hover {
        background-color: #f81717;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .admin-home-btn:active {
        transform: translateY(0);
    }
</style>
</head>
<body>

<h1 class="admin-header">🍴 Shared Spoon Admin</h1>
<a href="{{ route('admin.dashboard') }}" class="admin-home-btn">
    ⬅️ Return to Dashboard
</a>

    @yield('content')


<script src="{{ asset('js/app.js') }}"></script>
</body>
</html> --}}

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    :root {
            --primary-color: #FF6347;
            --secondary-color: #8BC34A;
            --accent-color: #FFA726;
            --dark-color: #6D4C41;
            --light-color: #FFF8E1;
            /* --light-color: white; */
        }
        body{
            background-color: var(--light-color);
        }

       /* Admin Header Styling */
    .admin-header {
        font-family: 'Pacifico', cursive;
        font-size: 2.5rem;
        color: var(--dark-color);
        text-align: center;
        margin-bottom: 2rem;
        padding: 1rem;
        background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeIn 1s ease;
    }
  /* Centered and Animated Admin Header */

    

    /* Admin Home Button Container */
    .admin-home-btn-container {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
        
    }

    /* Admin Home Button Styling */
    .admin-home-btn {
        background: var(--dark-color);
        color: var(--light-color);
        padding: 0.8rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .admin-home-btn:hover {
        background: var(--accent-color);
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .admin-header {
            font-size: 2rem;
        }

        .admin-home-btn-container {
            flex-direction: column;
            align-items: center;
        }

        .admin-home-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
</head>
<body>

{{-- <h1 class="admin-header">🍴 Shared Spoon Admin</h1> --}}

<div class="admin-home-btn-container">
    <a href="{{ route('admin.dashboard') }}" class="admin-home-btn">
        ⬅️ Admin Dashboard
    </a>
    <a href="{{ route('recipes.index') }}" class="admin-home-btn">
        ⬅️ Shared Spoon
    </a>
</div>

@yield('content')

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
