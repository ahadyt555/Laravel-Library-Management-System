<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\AssignedBook;

class BookController extends Controller
{
    public function create()
    {
        return view("books.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string",
            "author" => "required|string",
        ]);
        Book::create([
            "title" => $request->input("title"),
            "author" => $request->input("author"), 
        ]);
        return redirect()->back()->with('success', 'Book Created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        return view('admin.update-book', ["book" => $book]);
    }

    public function assignBook($id)
    {
        $book = Book::findOrFail($id);
        $book->status = 'issued';
        $book->save();
    
        AssignedBook::create([
            'book_id' => $book->id,
            'assigned_at' => now(),
            'admin_id' => auth()->user()->id,
        ]);
    
        return redirect()->route('admin.index')->with('success', 'Book assigned successfully.');
    }

    public function returnBook($id)
    {
        $book = Book::findOrFail($id);
        $book->status = 'available';
        // We can Delete return book request also so, it will not show in list after return
        $book->save();  
        return redirect()->route('dashboard')->with('success', 'Book returned successfully.');
    }

    public function update(Request $request)
    {   
        $requestdata = $request->validate([
            "title" => "required|string",
            "author" => "required|string",
        ]);
        Book::where('id', $request->id)->update(['title' => $requestdata['title'], 'author' => $requestdata['author']]);
        return redirect()->route('admin.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        Book::where('user_id', auth()->user()->id)->where('id', $request->id)->delete();
        return redirect()->route('admin.index')->with('success', 'Book Deleted successfully.');
    }
}
    