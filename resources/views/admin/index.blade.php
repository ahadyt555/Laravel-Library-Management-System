@extends('admin.master')
@section('content')
<div class="header">
    <div class="title">Admin Panel</div>
     <!-- Authentication -->
     <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div :href="route('logout')" style="cursor: pointer;position: relative;left: 662px;"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </div>
    </form>
    <button class="btn btn-primary add-book-btn" data-bs-toggle="modal" data-bs-target="#addBookModal">Add Book</button>
</div>
<div class="container mt-4">
    <!-- Books Table -->
    <h3>Books</h3>
    <table class="table table-bordered" id="booksTable">
        <thead>
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->status }}</td>
                    <td>
                        <form action="{{ route('books.delete', $book->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No Books Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Borrow Requests Table -->
    <h3 class="mt-5">Borrow Requests</h3>
    <table class="table table-bordered" id="borrowRequestsTable">
        <thead>
            <tr>
                <th>Book Name</th>
                <th>Requested By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookrequests as $request)
                <tr>
                    <td>{{ $request->book->title }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>
                        @php
                            $isAssigned = $issuanceRequests->where('book_id', $request->book->id)->isNotEmpty();
                        @endphp
                        <form method="POST" action="{{ route('books.assign', $request->book->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" {{ $isAssigned ? 'disabled' : '' }}>
                                {{ $isAssigned ? 'Assigned' : 'Assign' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No Borrow Requests Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBookModalLabel">Add Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="bookName" class="form-label">Book Name</label>
                        <input type="text" class="form-control" id="bookName" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="mb-3">
                        <label for="availability" class="form-label">Available</label>
                        <select class="form-select" id="availability" name="availability" required>
                            <option value="1">Available</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection