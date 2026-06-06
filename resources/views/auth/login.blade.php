@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <p class="text-uppercase text-primary fw-semibold small mb-1">Admin Access</p>
                                <h1 class="h3 mb-1">Login</h1>
                                <p class="text-secondary mb-0">Masuk untuk mengelola konten admin.</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="form-control"
                                        required
                                        autofocus
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" name="password" class="form-control" required>
                                </div>

                                <div class="form-check mb-4">
                                    <input id="remember" type="checkbox" name="remember" class="form-check-input">
                                    <label for="remember" class="form-check-label">Ingat saya</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </form>

                            <p class="text-center text-secondary small mt-4 mb-0">
                                Belum punya akun?
                                <a href="{{ route('register') }}">Register</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
