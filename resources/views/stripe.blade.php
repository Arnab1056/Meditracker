@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Stripe Payment</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Medicine Details</h5>
            <p><strong>Medicine Name:</strong> {{ request('medicine_name') }}</p>
            <p><strong>Quantity:</strong> {{ request('quantity') }}</p>
            <p><strong>Price:</strong> ${{ request('price') }}</p>
            <p><strong>Total:</strong> ${{ request('price') * request('quantity') }}</p>
        </div>
    </div>
    <form id="payment-form" action="{{ route('stripe.post') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ request('user_id') }}">
        <input type="hidden" name="medicine_id" value="{{ request('medicine_id') }}">
        <input type="hidden" name="quantity" value="{{ request('quantity') }}">
        <input type="hidden" name="price" value="{{ request('price') }}">
        <input type="hidden" name="pharmacy_id" value="{{ request('pharmacy_id') }}">

        <div id="card-element" class="form-control mt-3">
            <!-- Stripe Elements will create the card input here -->
        </div>
        <div id="card-errors" class="text-danger mt-2" role="alert"></div>

        <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method_id');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);

            form.submit();
        }
    });
</script>
@endsection