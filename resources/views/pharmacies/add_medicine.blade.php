@extends('pharmacies.layout')

@section('content')

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg w-50">
            <h2 class="text-center mb-4">Add Medicine</h2>
            <form action="{{ route('pharmacies.store_medicine') }}" method="POST">
                    <th>Details</th>
                    <th>Sold</th>
                    <th>Quantity</th>
                    <th>Pharmacy</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $medicine)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $medicine->name }}</td>
                        <td>{{ $medicine->date }}</td>
                        <td>{{ $medicine->detail }}</td>
                        <td>{{ $medicine->selled }}</td>
                        <td>{{ $medicine->quantity }}</td>
                        <td>{{ $medicine->pharmacy->name ?? 'N/A' }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('pharmacies.add_medicine_details', $medicine->id) }}">Add</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Add Medicine</h1>
        <form action="{{ route('pharmacies.store_medicine') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="pharmacy_id">Pharmacy</label>
                <select name="pharmacy_id" id="pharmacy_id" class="form-control">
                    @foreach($pharmacies as $pharmacy)
                        <option value="{{ $pharmacy->id }}">{{ $pharmacy->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="medicine_id">Medicine</label>
                <select name="medicine_id" id="medicine_id" class="form-control">
                    @foreach($medicines as $medicine)
                        <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" min="0" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Medicine</button>
        </form>
    </div>
@endsection
