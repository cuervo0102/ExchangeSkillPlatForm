<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">


    <style>

body {
    background: linear-gradient(135deg, #93C54B, #2E7D32);
    min-height: 100vh;
}

.form-container {
    background-color: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin: 2rem auto;
    max-width: 600px;
}

.form-label {
    color: #2E7D32;
    font-weight: 500;
}

.form-control:focus, .form-select:focus {
    border-color: #93C54B;
    box-shadow: 0 0 0 0.2rem rgba(147, 197, 75, 0.25);
}

.btn-custom {
    background: linear-gradient(to right, #93C54B, #2E7D32);
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.btn-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
}

.logo-container {
    text-align: center;
    margin-bottom: 2rem;
}

.login-link {
    color: #2E7D32;
    text-decoration: none;
    transition: all 0.3s ease;
}

.login-link:hover {
    color: #93C54B;
}


    </style>
</head>
<body>
    <div class="container py-5">
        <div class="form-container">
            <div class="logo-container">
                <h2 class="text-success mb-4">Student Login</h2>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="form-container">
                @csrf
        
                
                <div class="form-group mb-3">
                    <x-input-label for="email" :value="__('Email')" class="form-label" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>
        
                <
                <div class="form-group mt-4 mb-3">
                    <x-input-label for="password" :value="__('Password')" class="form-label" />
                    <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>
        
                <div class="form-check mb-3">
                    <label for="remember_me" class="form-check-label">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        {{ __('Remember me') }}
                    </label>
                </div>
        
                <div class="form-footer">
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
        
                    <x-primary-button class="btn-custom">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
