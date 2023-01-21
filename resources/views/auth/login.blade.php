@extends('layouts.app.main')

@section('title', 'Login')

@section('content')
    <div class="text-center mt-4">
        <h1 class="h2">Welcome back</h1>
        <p class="lead">
            Sign in to your account to continue
        </p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">
                @include('partials.alerts')
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Enter password" />
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary" name="submit">Log in</button>
                    </div>

                    <div>
                        Want to register? <a href="{{ route('register') }}">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
