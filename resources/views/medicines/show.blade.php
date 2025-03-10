@extends('medicines.layout')

@section('content')

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg w-50">
            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-4">Back</a>
            <h2 class="text-center mb-4">Show Medicine</h2>
            <form action="{{ route('medicines.store') }}" method="POST">
                @csrf
                <div class="text-center form-group mb-3">
                    <h5><strong><label>Name</label></strong></h5>
                    <h4> {{ $medicine->name }}
                        <h4>
                </div>

                <div class="text-center form-group mb-3">
                    <h5><strong><label>Date</label></strong></h5>
                    <h4> {{ $medicine->date }}
                        <h4>
                </div>

                <div class="text-center form-group mb-3">
                    <h5><strong><label>Details</label></strong></h5>
                    <h4> {{ $medicine->detail }}
                        <h4>
                </div>
                <div class="text-center form-group mb-3">
                    <h5><strong><label>Quantity</label></strong></h5>
                    <h4> {{ $medicine->quantity }}
                        <h4>
                </div>
                <div class="text-center form-group mb-3">
                    <h5><strong><label>Sold</label></strong></h5>
                    <h4> {{ $medicine->selled }}
                        <h4>
                </div>


                <div class="text-center">
                    <a class="btn btn-primary" href="{{ route('medicines.index') }}">Back</a>
                </div>

            </form>
        </div>
    </div>

@endsection