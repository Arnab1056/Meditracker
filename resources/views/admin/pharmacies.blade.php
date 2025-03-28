<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="{{ asset('js/color-modes.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pharmacy Management</title>
</head>
<body>
<main class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">MediTracker</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.page') }}" class="nav-link text-white">
                    User Management
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pharmacies') }}" class="nav-link active">
                    Pharmacy Management
                </a>
            </li>
        </ul>
        <hr>
    </div>

    <div class="container mt-4">
        <h2>Pharmacies</h2>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($pharmacies) && $pharmacies->isNotEmpty())
                    @foreach ($pharmacies as $pharmacy)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $pharmacy->name }}</td>
                        <td>{{ $pharmacy->location }}</td>
                        <td>{{ $pharmacy->phone }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPharmacyModal{{ $pharmacy->id }}">
                                Edit
                            </button>
                            <form action="{{ route('pharmacies.destroy', $pharmacy->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Pharmacy Modal -->
                    <div class="modal fade" id="editPharmacyModal{{ $pharmacy->id }}" tabindex="-1" aria-labelledby="editPharmacyModalLabel{{ $pharmacy->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPharmacyModalLabel{{ $pharmacy->id }}">Edit Pharmacy</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('pharmacies.update', $pharmacy->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name{{ $pharmacy->id }}" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name{{ $pharmacy->id }}" name="name" value="{{ $pharmacy->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="location{{ $pharmacy->id }}" class="form-label">Location</label>
                                            <input type="text" class="form-control" id="location{{ $pharmacy->id }}" name="location" value="{{ $pharmacy->location }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone{{ $pharmacy->id }}" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone{{ $pharmacy->id }}" name="phone" value="{{ $pharmacy->phone }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No pharmacies found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</main>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
