<?php

namespace App\Http\Controllers;

use App\Models\AssignedBook;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowRequest;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        $books = Book::all();
        $bookrequests = BorrowRequest::all();
        $issuanceRequests = AssignedBook::all();
        return view('admin.index', compact('books', 'bookrequests', 'issuanceRequests'));
    }

    public function dashboard(Request $request){
        $books = Book::all();
        $bookrequests = BorrowRequest::all();
        $issuanceRequests = AssignedBook::all();
        return view('dashboard',  compact('books', 'bookrequests', 'issuanceRequests'));
    }
}
