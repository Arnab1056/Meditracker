@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Add to Cart</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('cart.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}" readonly>
        </div>
        <div class="form-group">
            <label for="medicine_name">Medicine Name</label>
            <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="{{ $medicine->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="medicine_id">Medicine ID</label>
            <input type="text" class="form-control" id="medicine_id" name="medicine_id" value="{{ $medicine->id }}" readonly>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $price }}" readonly>
        </div>
        <div class="form-group">
            <label for="pharmacy_id">Pharmacy ID</label>
            <input type="text" class="form-control" id="pharmacy_id" name="pharmacy_id" value="{{ $pharmacy_id }}" readonly> <!-- Display pharmacy_id -->
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
        </div>
        <input type="hidden" name="pharmacy_id" value="{{ $pharmacy_id }}"> <!-- Ensure pharmacy_id is correctly named -->
        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
</div>
@endsection
