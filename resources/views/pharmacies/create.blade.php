@extends('pharmacies.layout')

@section('content')

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg w-50">
            <h2 class="text-center mb-4">Register New Pharmacy</h2>
            <form action="{{ route('pharmacies.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label>Pharmacy Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Google Maps Location URL</label>
                    <input type="url" name="location" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label>Type</label>
                    <input type="number" name="type" class="form-control" value="3" readonly>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Register Pharmacy</button>
                </div>
            </form>
        </div>
    </div>

@endsection
