@extends('layouts.user')

@section('content')
<div class="search-container" id="searchContainer">
    <h1>Search Medicines</h1>
    <form action="{{ route('search') }}" method="GET" onsubmit="moveSearchBar()">
        <input type="text" name="query" id="searchInput" placeholder="Search for medicines...">
        <button type="submit">Search</button>
    </form>
    <div id="results">
        @if(isset($results))
            <table>
                <thead>
                    <tr>
                        <th>Pharmacy Name</th>
                        <th>Medicine Name</th>
                        <th>Location</th>
                        <th>Available</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th> <!-- New column for action buttons -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->pharmacy_name }}</td>
                            <td>{{ $result->medicine_name }}</td>
                            <td><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($result->location) }}" target="_blank">{{ $result->location }}</a></td>
                            <td>{{ $result->available }}</td>
                            <td>{{ $result->quantity }}</td>
                            <td>{{ $result->price }}</td>
                            <td>
                                <form action="{{ route('cart.add', ['id' => $result->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No results found.</p>
        @endif
    </div>
</div>
<script>
    function moveSearchBar() {
        document.getElementById('searchContainer').classList.add('top');
    }
</script>
@endsection
