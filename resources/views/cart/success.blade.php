@extends('layouts.user')

@section('content')
<div class="container">
    <h1 class="text-success">Payment Successful</h1>
    <div class="alert alert-success">
        Your payment was successful! Thank you for your purchase.
    </div>
    <a href="{{ route('cart.show') }}" class="btn btn-primary">Back to Cart</a>
</div>
@endsection
