@extends('layouts.user')

@section('content')
<div class="container">
    <h1>All Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Medicine</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Pharmacy ID</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @if($order->status == 'pending' && $order->pharmacy->email == auth()->user()->email) <!-- Show only pending orders for logged-in pharmacy -->
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->medicine->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->totalPrice() }}</td>
                    <td>{{ $order->pharmacy_id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('orders.accept', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Accept Order</button>
                        </form>
                        <form action="{{ route('orders.decline', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-sm">Decline Order</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <h2>Accepted and Declined Orders</h2>
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Medicine</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Pharmacy ID</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @if(($order->status == 'accepted' || $order->status == 'declined') && $order->pharmacy->email == auth()->user()->email) <!-- Show accepted and declined orders for logged-in pharmacy -->
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->medicine->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->totalPrice() }}</td>
                    <td>{{ $order->pharmacy_id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('orders.remove', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning btn-sm">Remove Order</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection