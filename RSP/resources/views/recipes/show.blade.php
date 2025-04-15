
@extends('layout.app')

@section('title')
    View Recipe
@endsection

@section('content')
<style>
    /* Animated Elements */
    .floating-element {
        position: fixed;
        pointer-events: none;
        z-index: -1;
        width: 40px;
        height: 40px;
        background-size: contain;
        animation: float 8s infinite linear;
        opacity: 0.1;
    }

    @keyframes float {
        0% { transform: translateY(100vh) rotate(0deg); }
        100% { transform: translateY(-100vh) rotate(360deg); }
    }

    /* Recipe Card Styling */
    .recipe-card {
        background: linear-gradient(45deg, #FFF8F5 0%, #FFFFFF 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(255,107,107,0.1);
        transform: translateY(0);
        transition: all 0.3s ease;
        border: 2px solid var(--primary-color);
    }

    .recipe-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(255,107,107,0.2);
    }

    /* Section Headings */
    .section-title {
        position: relative;
        padding-bottom: 0.5rem;
        margin: 2rem 0 1.5rem;
        color: var(--dark-color);
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--secondary-color);
        border-radius: 2px;
    }

    /* Rating System */
    .rating-stars {
        display: flex;
        gap: 0.5rem;
        margin: 1.5rem 0;
    }

    .rating-star {
        cursor: pointer;
        transition: all 0.3s ease;
        color: #FFD700;
        font-size: 1.8rem;
    }

    .rating-star:hover {
        transform: scale(1.2);
        filter: brightness(1.2);
    }

    /* Comments Section */
    .comment-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        margin: 1.5rem 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transform-origin: top;
        animation: cardEnter 0.6s ease-out;
        border-left: 4px solid var(--accent-color);
    }

    @keyframes cardEnter {
        0% { transform: translateX(-30px); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
    }


     /* Updated Edit/Delete Button Styles */
    .btn-warning, .btn-danger {
        background-color: var( --dark-color);
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
        text-decoration: none;
    }

    .btn-warning:hover, .btn-danger:hover {
        background-color: var( --dark-color);
        transform: scale(1.05);
        color: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-decoration: none;
    }

   
</style>

<!-- Subtle Animated Background Elements -->
<div class="floating-element" style="left: 5%; background-image: url('icon-herb.svg')"></div>
<div class="floating-element" style="left: 95%; background-image: url('icon-spice.svg')"></div>

<div class="container mt-5">
    <div class="recipe-card">
        <!-- Recipe Header -->
        <div class="text-center mb-5">
            <h1 class="recipe-title">{{ $recipe->title }}</h1>
            <div class="text-muted">
                Created by <span class="text-primary">{{ $recipe->user->name }}</span>
            </div>
        </div>

        <!-- Recipe Content -->
        <div class="recipe-content">
            <div class="section-title">Description</div>
            <p class="lead">{{ $recipe->description }}</p>

            <div class="section-title">Ingredients</div>
            <div class="ingredient-list bg-light p-4 rounded-3">
                {!! nl2br(e($recipe->ingredient)) !!}
            </div>

            <div class="section-title">Instructions</div>
            <div class="instruction-steps bg-light p-4 rounded-3">
                {!! nl2br(e($recipe->instruction)) !!}
            </div>
        </div>

        <!-- Rating System -->
        
        <form action="{{ route('recipes.rate', $recipe) }}" method="POST">
            @csrf
            <div class="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                    <span class="rating-star" data-value="{{ $i }}">★</span>
                @endfor
            </div>
            <input type="hidden" id="rating-value" name="rating" value="0">
            <p> Only if you are authenticated, you can rate this recipe</p>
            @if(Auth::check())
            
            <button type="submit" class="btn-action btn-primary">Submit Rating</button>
            @endif
        </form>

        <!-- Comments Section -->
        <div class="mt-5">
            <div class="section-title">Comments</div>
            
            @foreach($recipe->comments as $comment)
                <div class="comment-card">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>{{ $comment->user->name }}</strong>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0">{{ $comment->comment }}</p>
                </div>
            @endforeach

            @auth
            <form method="POST" action="{{ route('comments.store') }}" class="mt-4">
                @csrf
                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                <textarea class="form-control mb-3" name="comment" 
                          placeholder="Share your thoughts..." 
                          rows="3" required></textarea>
                <button type="submit" class="btn-action btn-success">Post Comment</button>
            </form>
            @else
            <div class="alert alert-info mt-3">
                Please <a href="{{ route('login') }}" class="alert-link">sign in</a> to leave a comment
            </div>
            @endauth
        </div>

        <!-- Action Buttons -->
        @if(Auth::id() == $recipe->user_id)
        <div class="d-flex gap-3 mt-5 justify-content-center">
            <a href="{{ route('recipes.edit', $recipe->id) }}" 
               class="btn-action btn-warning">Edit Recipe</a>
            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="btn-action btn-danger"
                        onclick="return confirm('Are you sure you want to delete this recipe?')">
                    Delete Recipe
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

<script>
    // Rating System Interaction
    document.querySelectorAll('.rating-star').forEach(star => {
        star.addEventListener('mouseover', function() {
            const ratingValue = this.dataset.value;
            highlightStars(ratingValue);
        });

        star.addEventListener('mouseout', resetStars);
        
        star.addEventListener('click', function() {
            document.getElementById('rating-value').value = this.dataset.value;
        });
    });

    function highlightStars(ratingValue) {
        document.querySelectorAll('.rating-star').forEach((star, index) => {
            star.style.color = index < ratingValue ? '#FFA726' : '#e4e4e4';
        });
    }

    function resetStars() {
        const currentRating = document.getElementById('rating-value').value;
        highlightStars(currentRating);
    }

    // Dynamic background elements
    setInterval(() => {
        const icons = ['icon-leaf.svg', 'icon-pepper.svg'];
        const elem = document.createElement('div');
        elem.className = 'floating-element';
        elem.style.left = `${Math.random() * 95}%`;
        elem.style.backgroundImage = `url(${icons[Math.floor(Math.random() * icons.length)]})`;
        document.body.appendChild(elem);
        
        setTimeout(() => elem.remove(), 8000);
    }, 5000);
</script>
@endsection


