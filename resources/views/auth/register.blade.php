@extends('layout')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg w-50">
            <h2 class="text-center mb-4">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="role">Role:</label>
                    <select id="role" name="role" class="form-control" required>
                        <option value="1">Admin</option>
                        <option value="2">Medicine Maker</option>
                        <option value="3">Pharmacy</option>
                        <option value="4">User</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>

@endsection
