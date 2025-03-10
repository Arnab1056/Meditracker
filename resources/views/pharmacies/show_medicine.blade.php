@extends('pharmacies.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Show Medicine</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ url()->previous() }}"> Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <p class="form-control">{{ $pharmacyMedicine->medicine_name }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Details:</strong>
                    <p class="form-control">{{ $medicine->detail }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantity:</strong>
                    <p class="form-control">{{ $pharmacyMedicine->quantity }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <p class="form-control">{{ $pharmacyMedicine->price }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sold:</strong>
                    <p class="form-control">{{ $pharmacyMedicine->sold }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    .form-control {
        border: none;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
    }
</style>
