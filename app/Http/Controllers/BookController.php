<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Show all books
     */
    public function manageBookList()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Store or update book (only admin)
     */
    public function manageBookData(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only admins can manage books.');
        }

        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        if ($request->id) {
            // Update existing book
            $book = Book::findOrFail($request->id);
            $book->update($validated);
            $message = 'Book updated successfully!';
        } else {
            // Create new book
            Book::create($validated);
            $message = 'Book added successfully!';
        }

        return redirect()->route('books.list')->with('success', $message);
    }

    /**
     * Delete book (only admin)
     */
    public function deleteBook($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only admins can delete books.');
        }

        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.list')->with('success', 'Book deleted successfully!');
    }
}
