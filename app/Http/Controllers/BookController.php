<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->latest()->get();
        $authors = Author::all();
        $categories = Category::all();
        return view('dashboard', compact('books', 'authors', 'categories'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author_id' => 'nullable|exists:authors,id',
            'category_id' => 'nullable|exists:categories,id',
            'read_status' => 'required|in:readed,reading,not_read',
            'publisher' => 'nullable|string|max:255',
            'total_pages' => 'nullable|integer|min:1',
            'cover_price' => 'nullable|numeric|min:0',
            'country' => 'nullable|string|max:255',
        ]);
        Book::create($validated);
        return redirect()->route('books.index')->with('success', __('Book created successfully!'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'author_id' => 'nullable|exists:authors,id',
            'category_id' => 'nullable|exists:categories,id',
            'read_status' => 'required|in:readed,reading,not_read',
            'publisher' => 'nullable|string|max:255',
            'total_pages' => 'nullable|integer|min:1',
            'cover_price' => 'nullable|numeric|min:0',
            'country' => 'nullable|string|max:255',
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', __('Book updated successfully!'));
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', __('Book deleted successfully!'));
    }
}
