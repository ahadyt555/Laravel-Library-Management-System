<?php

namespace App\Http\Controllers;

use App\Models\BorrowRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        BorrowRequest::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'student_name' => Auth::user()->name,
        ]);

        return redirect()->back()->with('success', 'Borrow request created successfully.');
    }
}
