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
        $bookId = $request->id ?? null;

        if ($bookId) {
            // Find the book to update
            $book = Book::findOrFail($bookId);
            $this->authorize('update', $book); // policy check
        } else {
            $this->authorize('create', Book::class); // policy check
        }

        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        if ($bookId) {
            $book->update($validated);
            $message = 'Book updated successfully!';
        } else {
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
        $book = Book::findOrFail($id);
        $this->authorize('delete', $book); // policy check

        $book->delete();

        return redirect()->route('books.list')->with('success', 'Book deleted successfully!');
    }
}
