@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
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
    @if($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Medicine Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Status</th> <!-- New column for status -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->medicine->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td> <!-- Display price from carts table -->
                        <td>{{ $item->price * $item->quantity }}</td> <!-- Calculate total price -->
                        <td>{{ $item->status }}</td> <!-- Display status -->
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
