<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{

    public function index() {
        $books = Book::paginate(4);
        
        return Inertia::render('Books/Main', [
            'books' => $books,
        ]);
    }

    public function create() {
        return Inertia::render('Books/Create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'isbn' => 'required|numeric|unique:books,isbn',
            'value' => 'required|numeric|min:0',
            'image' => 'mimes:jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('image')->storeAs('public/books', $request->file('image')->getClientOriginalName());

        $url = Storage::url($path);

        Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'value' => $request->value,
            'image_url' => $url,
        ]);

        return Redirect::route('books')->with('success', 'Book created successfully');
    }

    public function read(Request $request) {
        $book = Book::find($request->id);

        return Inertia::render('Books/Read', [
            'book' => $book,
        ]);
    }

    public function edit(Request $request) {
        $book = Book::find($request->id);

        return Inertia::render('Books/Edit', [
            'book' => $book
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'isbn' => 'required|numeric|unique:books,isbn,' . $request->id,
            'value' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);
    
        $book = Book::find($request->id);
    
        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            Storage::delete($book->image_url);
    
            // Store the new image
            $path = $request->file('image')->storeAs('public/books', $request->file('image')->getClientOriginalName());
            $url = Storage::url($path);
        } else {
            $url = $book->image_url; // Use the existing image URL if no new image is provided
        }
    
        // Update the book record
        $book->update([
            'name' => $request->name,
            'isbn' => $request->isbn,
            'value' => $request->value,
            'image_url' => $url,
        ]);
    
        // Assuming 'stores' is an array of related store IDs sent in the request
        $book->stores()->sync($request->stores);
    
        return redirect()->route('books')->with('success', 'Book updated successfully');
    }

    public function delete(Request $request) {
        $book = Book::find($request->id);

        if ($book) {
            $book->delete();

            return redirect()->route('books')->with('success', 'Book deleted successfully');
        } else {
            return redirect()->route('books')->with('error', 'Book not found or already deleted');
        }
    }
    
}
