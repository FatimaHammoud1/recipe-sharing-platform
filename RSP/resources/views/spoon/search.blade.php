
@extends('layout.app')

@section('content')
    <style>
    
        /* Heading Styling */
        h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        /* Form Styling */
        form {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        form input[type="text"] {
            padding: 0.8rem 1.5rem;
            border: 2px solid var(--primary-color);
            border-radius: 25px;
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            color: var(--dark-color);
            outline: none;
            transition: all 0.3s ease;
        }

        form input[type="text"]:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 10px rgba(255, 99, 71, 0.3);
        }

        form button {
            padding: 0.8rem 1.5rem;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: var(--light-color);
            border: none;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        form button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Recipe List Styling */
        ul {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        ul li {
            background: var(--light-color);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        ul li:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        ul li a {
            display: block;
            text-decoration: none;
            color: var(--dark-color);
            padding: 1rem;
            text-align: center;
        }

        ul li a img {
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        ul li a:hover {
            color: var(--primary-color);
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

            form {
                flex-direction: column;
                align-items: center;
            }

            form input[type="text"],
            form button {
                width: 100%;
                text-align: center;
            }

            ul {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <h1>More Recipes With Spoonacular</h1>
    
    <form action="{{ route('spoon.search') }}" method="GET">
        <input type="text" name="query" placeholder="Enter recipe name">
        <button type="submit">Search</button>
    </form>

    @if(isset($recipes['results']))
        <ul>
            @foreach($recipes['results'] as $recipe)
                <li>
                    <a href="{{ route('spoon.show', $recipe['id']) }}">
                        <img src="{{ $recipe['image'] }}" width="100">
                        {{ $recipe['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
