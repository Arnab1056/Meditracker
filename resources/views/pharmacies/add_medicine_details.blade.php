@extends('pharmacies.layout')

@section('content')

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg w-50">
            <h2 class="text-center mb-4">Add Medicine Details</h2>

            <form action="{{ route('pharmacies.store_medicine') }}" method="POST">
                @csrf
                <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">
                <input type="hidden" name="medicine_name" value="{{ $medicine->name }}">
                <input type="hidden" name="status" value="pending"> <!-- Ensure status is set to pending -->

                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="medicine_name" value="{{ $medicine->name }}" class="form-control" readonly>
                </div>

                <div class="form-group mb-3">
                    <label>Details</label>
                    <textarea name="medicine_detail" class="form-control" readonly>{{ $medicine->detail }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Sold</label>
                    <input type="number" name="sold" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Medicine</button>
                </div>
            </form>
        </div>
    </div>

@endsection
