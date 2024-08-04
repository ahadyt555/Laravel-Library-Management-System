@extends('admin.master');
@section('content')
    <div class="header">
        <div class="title">Update Book</div>
    </div>
    <div class="container justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Update Record</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('books.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="bookId" name="id" value="{{ $book->id }}">
                            <div class="mb-3">
                                <label for="recordName" class="form-label">Book Name</label>
                                <input type="text" class="form-control" id="recordName" name="title" value="{{ $book->title }}" required>
                            </div>
                            <div class="mb-3">       
                                <label for="recordDescription" class="form-label">Author</label>
                                <input class="form-control" id="recordDescription" name="author" value ="{{ $book->author }}" rows="3" required></input>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection
