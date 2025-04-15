
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shared Spoon - Share Your Culinary Story</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FF6347; /* Tomato red */
            --secondary-color: #8BC34A; /* Fresh basil green */
            --accent-color: #FFA726; /* Carrot orange */
            --dark-color: #6D4C41; /* Coffee brown */
            --light-color: #FFF8E1; /* Warm cream */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
        }

        .hero-section {
            background: linear-gradient(rgba(109, 76, 65, 0.8), rgba(109, 76, 65, 0.8)),
                        url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') center/cover;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section-secondary {
            background: linear-gradient(rgba(109, 76, 65, 0.6), rgba(109, 76, 65, 0.6)),
                        url('https://images.unsplash.com/photo-1556911220-bff31c812dba?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1920&q=80') center/cover;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease;
        }

        .brand-logo {
            position: absolute;
            top: 20px;
            right: 70%;
            transform: translateX(-50%);
            color: var(--accent-color);
            font-family: 'Playfair Display', serif;
            font-size: 250%;
            text-decoration: none;
            animation: float 3s ease-in-out infinite;
            display: flex;
            align-items: right;
        }

        /* .brand-logo::before{
            content: '🥄';
            margin-left: 10px;
            /* animation: spin 4s linear infinite; */
        /* } */ 

        .cta-btn {
            padding: 1rem 2.5rem;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 1rem;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .cta-btn::after {
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

        .kitchen-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: white;
        }

        .spoonacular-btn {
            background: linear-gradient(45deg, var(--secondary-color), #689F38);
            color: white;
        }

        .about-section {
            background: var(--dark-color);
            color: white;
            padding: 5rem 0;
            text-align: center;
        }

        .feature-stat {
            font-size: 2.5rem;
            color: var(--accent-color);
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        .about-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            background: var(--secondary-color);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            animation: float 3s ease-in-out infinite;
        }

        .about-btn i {
            animation: bounce 1s infinite;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes shine {
            0% { left: -50%; }
            100% { left: 150%; }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .cta-btn {
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
            }

            .brand-logo {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating About Button -->
    <button class="about-btn" onclick="document.getElementById('about').scrollIntoView({ behavior: 'smooth' })">
        About Us <i class="ms-2 fas fa-chevron-down"></i>
    </button>

    <!-- First Hero Section -->
    
    <section class="hero-section">
        <a class="brand-logo" href="#">
            The Shared Spoon
        </a>
        <div class="container">
            <h1 class="hero-title mb-4">Share Your Culinary Masterpieces</h1>
            <button class="cta-btn kitchen-btn" onclick="window.location.href='{{ route('recipes.index') }}'">
                From Your Kitchen to Ours <i class="ms-2 fas fa-utensils"></i>
            </button>
        </div>
    </section>

    <!-- Second Hero Section with cooking utensils background -->
    <section class="hero-section hero-section-secondary">
        <div class="container">
            <h1 class="hero-title mb-4">Discover AI-Enhanced Recipes</h1>
            <button class="cta-btn spoonacular-btn" onclick="window.location.href='{{ route('spoon.search') }}'">
                Ask Spoonacular: Your Home Chef <i class="ms-2 fas fa-search"></i>
            </button>
            <p class="mt-3">Unlock 50,000+ professional recipes with our AI-powered culinary genius</p>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <h2 class="mb-4">Our Recipe for Success</h2>
                <div class="mb-4">
                    <span class="feature-stat">50K+</span>
                    <p class="text-uppercase mb-0">Recipes Shared</p>
                </div>
                <p class="lead">The Shared Spoon is a vibrant community where home chefs and food lovers unite to share, discover, and elevate their cooking experiences. Born from a passion for authentic home cooking and cutting-edge culinary technology, we bridge tradition and innovation.</p>
                <div class="row mt-5">
                    <div class="col-md-4 mb-4" style="animation-delay: 0.2s;">
                        <i class="fas fa-heart fa-2x mb-3" style="color: var(--primary-color);"></i>
                        <h4>Passion-Driven</h4>
                        <p>Created by chefs, for food enthusiasts</p>
                    </div>
                    <div class="col-md-4 mb-4" style="animation-delay: 0.4s;">
                        <i class="fas fa-lightbulb fa-2x mb-3" style="color: var(--secondary-color);"></i>
                        <h4>AI-Enhanced</h4>
                        <p>Smart recipe suggestions powered by Spoonacular</p>
                    </div>
                    <div class="col-md-4 mb-4" style="animation-delay: 0.6s;">
                        <i class="fas fa-users fa-2x mb-3" style="color: var(--accent-color);"></i>
                        <h4>Community First</h4>
                        <p>Join our global family of food lovers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
</body>
</html>