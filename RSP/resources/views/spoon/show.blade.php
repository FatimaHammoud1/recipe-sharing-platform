{{-- @extends('layout.app')

@section('content')
    <h1>{{ $recipe['title'] }}</h1>
    <img src="{{ $recipe['image'] }}" width="200">

    <h2>Ingredients</h2>
    <ul>
        @foreach($recipe['extendedIngredients'] as $ingredient)
            <li>{{ $ingredient['original'] }}</li>
        @endforeach
    </ul>

    <h2>Instructions</h2>
    <p>{!! nl2br(e($recipe['instructions'] ?? 'No instructions available.')) !!}</p>

    <a href="{{ route('spoon.search') }}">Back to Search</a>
@endsection --}}



<!DOCTYPE html>
<head>
    <title>{{ $recipe['title'] }} | Spoonacular</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <style>
       
       :root {
            --primary-color: #FF6347;
            --secondary-color: #8BC34A;
            --accent-color: #FFA726;
            --dark-color: #6D4C41;
            --light-color: #FFF8E1;
            
        }

        /* Heading Styling */
        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        /* Image Styling */
        img {
            display: block;
            margin: 0 auto 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* List Styling */
        ul {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }

        ul li {
            background: var(--light-color);
            padding: 0.8rem 1.5rem;
            margin-bottom: 0.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            color: var(--dark-color);
            transition: all 0.3s ease;
        }

        ul li:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Instructions Styling */
        p {
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            color: var(--dark-color);
            line-height: 1.6;
            background: var(--light-color);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Back Link Styling */
        a {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.8rem 1.5rem;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: var(--light-color);
            border: none;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
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

            h2 {
                font-size: 1.5rem;
            }

            img {
                width: 150px;
            }

            ul li {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            p {
                padding: 1rem;
                font-size: 0.9rem;
            }

            a {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <h1>{{ $recipe['title'] }}</h1>
    <img src="{{ $recipe['image'] }}" width="200">

    <h2>Ingredients</h2>
    <ul>
        @foreach($recipe['extendedIngredients'] as $ingredient)
            <li>{{ $ingredient['original'] }}</li>
        @endforeach
    </ul>

    <h2>Instructions</h2>
    <p>{!! nl2br(e($recipe['instructions'] ?? 'No instructions available.')) !!}</p>

    <a href="{{ route('spoon.search') }}">Back to Search</a>
</body>