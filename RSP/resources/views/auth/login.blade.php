{{-- @extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layout.app')

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
        .container {
            padding: 2rem;
            background-color: var(--light-color);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: var(--light-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: var(--light-color);
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            padding: 1rem;
            border-bottom: none;
        }

        .card-body {
            padding: 2rem;
        }

        /* Form Styling */
        .form-control {
            border: 2px solid var(--primary-color);
            border-radius: 25px;
            padding: 0.8rem 1.5rem;
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            color: var(--dark-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 10px rgba(255, 99, 71, 0.3);
        }

        .form-control.is-invalid {
            border-color: #F44336;
        }

        .invalid-feedback {
            font-family: 'Open Sans', sans-serif;
            font-size: 0.9rem;
            color: #F44336;
        }

        /* Label Styling */
        .col-form-label {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            color: var(--dark-color);
            font-weight: 500;
        }

        /* Checkbox Styling */
        .form-check-input {
            border: 2px solid var(--primary-color);
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            font-family: 'Open Sans', sans-serif;
            font-size: 0.9rem;
            color: var(--dark-color);
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            color: var(--light-color);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-link {
            color: var(--primary-color);
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-link:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-header {
                font-size: 1.25rem;
            }

            .form-control {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .col-form-label {
                font-size: 0.9rem;
            }

            .btn-primary {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .btn-link {
                font-size: 0.9rem;
            }
        }
    </style>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    <div class="mt-3">
                                    <p>If you donot have an account, please <a href="{{ route('register') }}">Register</a></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   
@endsection
