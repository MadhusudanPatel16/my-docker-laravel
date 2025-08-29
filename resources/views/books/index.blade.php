@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📚 Manage Books</h2>

    <!-- Flash message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add / Update Book Form -->
    @if(auth()->user()->role === 'admin')
        <form method="POST" action="{{ route('books.store') }}" id="book-form" class="mb-4">
            @csrf
            <input type="hidden" name="id" id="book-id"> <!-- hidden field for update -->
            <div class="row g-3">
                <div class="col-md-5">
                    <input type="text" name="title" id="book-title" class="form-control" placeholder="Book Title" required>
                </div>
                <div class="col-md-5">
                    <input type="text" name="author" id="book-author" class="form-control" placeholder="Author" required>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary" id="book-submit">Add Book</button>
                </div>
            </div>
        </form>
    @endif

    <!-- Books Table -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        @if(auth()->user()->role === 'admin')
                            <th width="200">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editBook({{ $book->id }}, '{{ addslashes($book->title) }}', '{{ addslashes($book->author) }}')">Update</button>
                                    <form method="POST" action="{{ route('books.delete', $book->id) }}" onsubmit="return confirm('Are you sure?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'admin' ? 4 : 3 }}" class="text-muted">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">{{ $books->links() }}</div>
        </div>
    </div>
</div>

<script>
function editBook(id, title, author) {
    document.getElementById('book-id').value = id;
    document.getElementById('book-title').value = title;
    document.getElementById('book-author').value = author;
    document.getElementById('book-submit').innerText = 'Update Book';
}
</script>
@endsection
