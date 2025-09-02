@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">👤 Manage Users</h2>

    <!-- Flash message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add / Update User Form -->
    @if(auth()->user()->role === 'admin')
        <form method="POST" action="{{ route('users.store') }}" id="user-form" class="mb-4">
            @csrf
            <input type="hidden" name="id" id="user-id"> <!-- hidden field for update -->

            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="name" id="user-name" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="col-md-3">
                    <input type="email" name="email" id="user-email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-2">
                    <select name="role" id="user-role" class="form-control" required>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" id="user-status" class="form-control" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="banned">Banned</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="password" name="password" id="user-password" class="form-control" placeholder="Password">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary" id="user-submit">Add User</button>
                </div>
            </div>
        </form>
    @endif

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        @if(auth()->user()->role === 'admin')
                            <th width="200">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ ucfirst($user->status) }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="editUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ $user->role }}', '{{ $user->status }}')">
                                        Update
                                    </button>
                                    <form method="POST" action="{{ route('users.delete', $user->id) }}" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">{{ $users->links() }}</div>
        </div>
    </div>
</div>

<script>
function editUser(id, name, email, role, status) {
    document.getElementById('user-id').value = id;
    document.getElementById('user-name').value = name;
    document.getElementById('user-email').value = email;
    document.getElementById('user-role').value = role;
    document.getElementById('user-status').value = status;
    document.getElementById('user-password').value = '';
    document.getElementById('user-submit').innerText = 'Update User';
}
</script>
@endsection
