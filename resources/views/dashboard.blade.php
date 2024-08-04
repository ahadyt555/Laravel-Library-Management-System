<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
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
                            @php
                                $requestExists = $bookrequests->where('book_id', $book->id)->isNotEmpty();
                            @endphp
                            @if ($book->status === 'available' && !$requestExists)
                                <form method="POST" action="{{ route('borrow.request') }}">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-info btn-sm">Borrow</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>{{ $requestExists ? 'Requested' : 'Unavailable' }}</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No Books Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
     <!-- Issuance Requests Table -->
    <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="position: relative;left: 130px;">
        {{ __('Issuance Requests') }}
    </h2>
    <div class="container mt-4" >
     <table class="table table-bordered" id="issuanceRequestsTable">
         <thead>
             <tr>
                 <th>Book Name</th>
                 <th>Assigned By</th>
                 <th>Actions</th>
             </tr>
         </thead>
         <tbody>
             @forelse($issuanceRequests as $request)
                 <tr>
                     <td>{{ $request->book->title }}</td>
                     <td>{{ $request->admin->name }}</td>
                     <td>
                         <form method="POST" action="{{ route('books.return', $request->book->id) }}">
                             @csrf
                             <button type="submit" class="btn btn-danger btn-sm">Return</button>
                         </form>
                     </td>
                 </tr>
             @empty
                 <tr>
                     <td colspan="3">No Issuance Requests Found</td>
                 </tr>
             @endforelse
         </tbody>
     </table>
    </div>
</x-app-layout>