@extends('medicines.layout')

@section('content')

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Back</a>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg w-50">
            <h2 class="text-center mb-4">Add New Medicine</h2>

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('duplicate'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <form action="{{ route('medicines.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Details</label>
                    <textarea name="detail" class="form-control" rows="4"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label>Selled</label>
                    <input type="number" name="selled" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>

                <!-- Input fields for maker name and maker id -->
                <div class="form-group mb-3">
                    <label>Maker Name</label>
                    <input type="text" name="maker_name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="form-group mb-4">
                    <label>Maker ID</label>
                    <input type="text" name="maker_id" class="form-control" value="{{ Auth::user()->id }}" readonly>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Medicine</button>
                </div>
            </form>
        </div>
    </div>

@endsection