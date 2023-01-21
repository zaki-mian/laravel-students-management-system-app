@extends('layouts.app.main')

@section('title', 'Register')

@section('content')
    <div class="text-center mt-4">
        <h1 class="h2">Get started</h1>
        <p class="lead">
            Start creating the worst possible user experience for yourself as a developer.
        </p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">

                @include('partials.alerts')

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text"
                            name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}">

                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>
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
                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Confrim Password</label>
                        <input class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter password" />

                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="profile_picture">Profile Picture</label>
                        <input class="form-control form-control-lg @error('profile_picture') is-invalid @enderror" type="file" name="profile_picture" id="profile_picture">

                        @error('profile_picture')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary" name="submit">Register</button>
                    </div>
                    <div>
                        Already registered? <a href="{{ route('login') }}">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
