@extends('layout')

@section('content')
    <div class="container text-center mt-5">
        <h2>Login or Register</h2>
        <div class="d-flex justify-content-center mt-4" style="gap: 20px;">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        </div>
    </div>
@endsection