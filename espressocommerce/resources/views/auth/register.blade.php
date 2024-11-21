@extends('layout.master')

@section('style')
<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        font-family: Arial, sans-serif;
    }

    section {
        background: url('https://source.unsplash.com/random/1920x1080/?business,register') no-repeat center center/cover;
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    /* Background Overlay */
    section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 1;
    }

    /* Sign-Up Container */
    .signup-container {
        position: relative;
        z-index: 2;
        background: rgba(0, 0, 0, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        width: 90%;
        max-width: 400px;
        padding: 30px;
        text-align: center;
        color: white;
    }

    .signup-container h1 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .signup-container h3 {
        font-size: 1.2rem;
        font-weight: normal;
        margin-bottom: 20px;
        color: #ccc;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        background: transparent;
        color: white;
        font-size: 0.9rem;
        outline: none;
    }

    .form-group input::placeholder {
        color: #aaa;
    }

    .form-group input:focus {
        border-color: #4a90e2;
    }

    .btn {
        display: inline-block;
        width: 100%;
        padding: 10px 20px;
        background: #4a90e2;
        border: none;
        border-radius: 20px;
        font-size: 1rem;
        font-weight: bold;
        color: white;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn:hover {
        background: transparent;
        border: 1px solid #4a90e2;
        color: #4a90e2;
    }

    .alert {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .alert-success {
        color: #28a745;
    }

    .alert-danger {
        color: #dc3545;
    }

    .login-link {
        margin-top: 15px;
        color: #4caf50;
        text-decoration: none;
    }

    .login-link:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<section>
    <!-- Sign-Up form container -->
    <div class="signup-container">
        <h1>Ecommerce Application</h1>
        <h3>Sign-Up Page</h3>

        <!-- Form -->
        <form action="{{ route('auth.registerpost') }}" method="POST">
            @csrf

            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    placeholder="Enter Name"
                    required
                />
                @error('name')
                <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    placeholder="Enter Email"
                    required
                />
                @error('email')
                <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter Password"
                    required
                />
                @error('password')
                <span class="alert alert-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Success Message -->
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif

            <!-- Error Message -->
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @endif

            <!-- Sign-Up Button -->
            <button type="submit" class="btn">Sign Up</button>
        </form>

        <!-- Log-In link -->
        <div>
            <span>Already Have an Account? </span>
            <a href="{{ route('auth.login') }}" class="login-link">Log In</a>
        </div>
    </div>
</section>
@endsection
