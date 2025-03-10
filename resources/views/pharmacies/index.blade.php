@extends('pharmacies.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Pharmacy Management</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit', auth()->user()->id) }}"> Edit User</a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-3">
                <div class="list-group">
                    <a href="{{ route('users.edit', auth()->user()->id) }}" class="list-group-item list-group-item-action">Edit User</a>
                    <a href="{{ route('pharmacies.medicines', ['pharmacy' => auth()->user()->pharmacy->id]) }}" class="list-group-item list-group-item-action">Add Medicine</a>
                    <a href="{{ route('orders.index', ['pharmacy' => auth()->user()->pharmacy->id]) }}" class="list-group-item list-group-item-action">Order Page</a>
                    <a href="{{ route('cart.orders') }}" class="list-group-item list-group-item-action">All Orders</a> <!-- Add link to orders page -->
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row mb-3">
                    <div class="col-md-12 text-right">
                        <form method="GET" action="{{ route('pharmacies.index') }}" class="form-inline justify-content-end">
                            <input type="text" name="search" id="search" placeholder="Search medicines..." value="{{ request()->query('search') }}" class="form-control form-control-sm rounded" style="width: 150px; margin-right: 5px;">
                            <button type="submit" class="btn btn-primary btn-sm rounded">Search</button>
                        </form>
                    </div>
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

                <table class="table table-bordered" id="pharmacy-medicines-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Sold</th>
                            <th width="380px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pharmacyMedicines as $pharmacyMedicine)
                            @if ($pharmacyMedicine->status !== 'pending')
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $pharmacyMedicine->medicine_name }}</td>
                                    <td>{{ $pharmacyMedicine->quantity }}</td>
                                    <td>{{ $pharmacyMedicine->price }}</td>
                                    <td>{{ $pharmacyMedicine->sold }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm rounded" href="{{ route('pharmacies.showMedicine', $pharmacyMedicine->id) }}">View</a>
                                        <form action="{{ route('pharmacies.destroyMedicine', $pharmacyMedicine->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded">Delete</button>
                                        </form>
                                        <form action="{{ route('pharmacies.sell', $pharmacyMedicine->medicine_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="number" name="sellQuantity" class="form-control form-control-sm d-inline rounded" style="width: 80px;" required>
                                            <button type="submit" class="btn btn-warning btn-sm rounded">Sell</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                {!! $pharmacyMedicines->links() !!}
            </div>
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
    .pull-right {
        float: right;
    }
    .pull-left {
        float: left;
    }
    .margin-tb {
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .table {
        margin-top: 20px;
    }
    .thead-dark th {
        background-color: #343a40;
        color: white;
    }
</style>
