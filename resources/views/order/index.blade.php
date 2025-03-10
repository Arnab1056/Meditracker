@extends('medicines.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Medicine Management</h2>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Pharmacy ID</th>
                        <th>Medicine ID</th>
                        <th>Medicine Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Sold</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pharmacy_medicines as $pharmacy_medicine)
                        @if ($pharmacy_medicine->status == 'pending' && $pharmacy_medicine->medicine->maker_id == auth()->user()->id)
                            <tr>
                                <td>{{ $pharmacy_medicine->pharmacy_id }}</td>
                                <td>{{ $pharmacy_medicine->medicine_id }}</td>
                                <td>{{ $pharmacy_medicine->medicine->name }}</td>
                                <td>{{ $pharmacy_medicine->quantity }}</td>
                                <td>
                                    <form action="{{ route('pharmacy_medicines.updatePrice', $pharmacy_medicine->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="price" value="{{ $pharmacy_medicine->price }}" class="form-control form-control-sm d-inline rounded" style="width: 80px;" required>
                                        <button type="submit" class="btn btn-primary btn-sm rounded">Update</button>
                                    </form>
                                </td>
                                <td>{{ $pharmacy_medicine->sold }}</td>
                                <td>{{ $pharmacy_medicine->status }}</td>
                                <td>
                                    <form action="{{ route('pharmacy_medicines.accept', $pharmacy_medicine->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm rounded">Accept</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<style>
    .btn-primary, .btn-success, .btn-info, .btn-danger, .btn-warning {
        border-radius: 15px;
    }
    .form-control {
        display: inline-block;
        width: auto;
        border-radius: 15px;
    }
</style>