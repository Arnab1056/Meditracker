<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="{{ asset('js/color-modes.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medicine Management</title>
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
                <a href="{{ route('admin.medicines') }}" class="nav-link active">
                    Medicine Management
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
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($users) && $users->isNotEmpty())
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMakerModal{{ $user->id }}">
                                Edit
                            </button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Maker Modal -->
                    <div class="modal fade" id="editMakerModal{{ $user->id }}" tabindex="-1" aria-labelledby="editMakerModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMakerModalLabel{{ $user->id }}">Edit Maker</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name{{ $user->id }}" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email{{ $user->id }}" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role{{ $user->id }}" class="form-label">Role</label>
                                            <input type="text" class="form-control" id="role{{ $user->id }}" name="role" value="{{ $user->role }}" readonly>
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
                        <td colspan="5" class="text-center">No users found with role=2.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</main>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
