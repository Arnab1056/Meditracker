@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Payment Cancelled</h1>
    <div class="alert alert-warning">
        Your payment has been cancelled. Please try again or contact support if you need assistance.
    </div>
    <a href="{{ route('cart.show') }}" class="btn btn-primary">Back to Cart</a>
</div>
@endsection
