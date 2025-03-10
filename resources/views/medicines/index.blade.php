@extends('medicines.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Medicine Management</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success btn-sm" href="{{ route('medicines.create') }}"> Create New Medicine</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('order.page') }}"> Order Medicines</a> <!-- Added Order Medicines button -->
                </div>
            </div>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>

        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <form method="GET" action="{{ route('medicines.index') }}" class="form-inline justify-content-end">
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

        <table class="table" id="medicines-table">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Date</th>
                <th>Details</th>
                <th>Sold</th>
                <th>Quantity</th>
                <th width="380px">Action</th>
            </tr>
            @foreach ($medicines as $medicine)
                @if ($medicine->maker_id == Auth::id())
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $medicine->name }}</td>
                        <td>{{ $medicine->date }}</td>
                        <td>{{ $medicine->detail }}</td>
                        <td>{{ $medicine->selled }}</td>
                        <td>{{ $medicine->quantity }}</td>
                        <td>
                            <a class="btn btn-info btn-sm rounded" href="{{ route('medicines.show', $medicine->id) }}">View</a>
                            <a class="btn btn-primary btn-sm rounded" href="{{ route('medicines.edit', $medicine->id) }}">Edit</a>
                            <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded">Delete</button>
                            </form>
                            <form action="{{ route('medicines.sell', $medicine->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="number" name="sellQuantity" class="form-control form-control-sm d-inline rounded" style="width: 80px;" required>
                                <button type="submit" class="btn btn-warning btn-sm rounded">Sell</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>

        {!! $medicines->links() !!}
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