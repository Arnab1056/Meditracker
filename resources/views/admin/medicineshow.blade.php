<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="{{ asset('js/color-modes.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medicine Show</title>
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
                <a href="{{ route('admin.pharmacies') }}" class="nav-link text-white">
                    Pharmacy Management
                </a>
            </li>
            <li>
                <a href="{{ route('admin.medicines.show') }}" class="nav-link active">
                    Medicine Show
                </a>
            </li>
        </ul>
        <hr>
    </div>

    <div class="container mt-4">
        <h2>Medicines</h2>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Selled</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Maker Name</th>
                    <th scope="col">Maker ID</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($medicines) && $medicines->isNotEmpty())
                    @foreach ($medicines as $medicine)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $medicine->name }}</td>
                        <td>{{ $medicine->date }}</td>
                        <td>{{ $medicine->detail }}</td>
                        <td>{{ $medicine->selled }}</td>
                        <td>{{ $medicine->quantity }}</td>
                        <td>{{ $medicine->maker_name }}</td>
                        <td>{{ $medicine->maker_id }}</th>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMedicineModal{{ $medicine->id }}">
                                Edit
                            </button>
                            <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Medicine Modal -->
                    <div class="modal fade" id="editMedicineModal{{ $medicine->id }}" tabindex="-1" aria-labelledby="editMedicineModalLabel{{ $medicine->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMedicineModalLabel{{ $medicine->id }}">Edit Medicine</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name{{ $medicine->id }}" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name{{ $medicine->id }}" name="name" value="{{ $medicine->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="date{{ $medicine->id }}" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="date{{ $medicine->id }}" name="date" value="{{ $medicine->date }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="detail{{ $medicine->id }}" class="form-label">Detail</label>
                                            <textarea class="form-control" id="detail{{ $medicine->id }}" name="detail" required>{{ $medicine->detail }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="selled{{ $medicine->id }}" class="form-label">Selled</label>
                                            <input type="number" class="form-control" id="selled{{ $medicine->id }}" name="selled" value="{{ $medicine->selled }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity{{ $medicine->id }}" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="quantity{{ $medicine->id }}" name="quantity" value="{{ $medicine->quantity }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="maker_name{{ $medicine->id }}" class="form-label">Maker Name</label>
                                            <input type="text" class="form-control" id="maker_name{{ $medicine->id }}" name="maker_name" value="{{ $medicine->maker_name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="maker_id{{ $medicine->id }}" class="form-label">Maker ID</label>
                                            <input type="text" class="form-control" id="maker_id{{ $medicine->id }}" name="maker_id" value="{{ $medicine->maker_id }}" required>
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
                        <td colspan="9" class="text-center">No medicines found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</main>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
