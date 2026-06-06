@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <p class="text-uppercase text-primary fw-semibold small mb-1">Admin Access</p>
                                <h1 class="h3 mb-1">Register</h1>
                                <p class="text-secondary mb-0">Buat akun untuk masuk ke Admin Panel.</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input
                                        id="name"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        class="form-control"
                                        required
                                        autofocus
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" name="password" class="form-control" required>
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Register</button>
                            </form>

                            <p class="text-center text-secondary small mt-4 mb-0">
                                Sudah punya akun?
                                <a href="{{ route('login') }}">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
