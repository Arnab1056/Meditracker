@extends('pharmacies.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Pharmacy Medicines</h2>
                </div>
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

        <table class="table">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th>Quantity</th>
                <th>Maker Name</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($medicines as $medicine)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->detail }}</td>
                    <td>{{ $medicine->quantity }}</td>
                    <td>{{ $medicine->maker_name }}</td>
                    <td>
                        <a class="btn btn-success" href="{{ route('pharmacies.addMedicineForm', ['pharmacy' => $pharmacy->id, 'medicine' => $medicine->id]) }}">Add</a>
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $medicines->links() !!}
    </div>

@endsection
