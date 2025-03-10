@extends('medicines.layout')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg w-50">
            <h2 class="text-center mb-4">Edit Medicine</h2>

            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Back</a>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', $medicine->name) }}" class="form-control"
                        placeholder="Medicine Name">
                </div>

                <div class="form-group mb-3">
                    <label>Date</label>
                    <input type="date" name="date" value="{{ old('date', $medicine->date) }}" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Details</label>

                    <textarea class="form-control" style="height:150px" name="detail"
                        placeholder="Details of the medicine">{{ old('detail', $medicine->detail) }}</textarea>
                </div>
                <div class="form-group mb-4">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $medicine->quantity) }}"
                        class="form-control" placeholder="Quantity">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Medicine</button>
                </div>
            </form>
        </div>
    </div>

@endsection