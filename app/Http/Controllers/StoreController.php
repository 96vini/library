<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Store;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class StoreController extends Controller
{
    public function index() {
        $stores = Store::paginate(10);

        return Inertia::render('Stores/Main', [
            'stores' => $stores
        ]);
    }

    public function create() {
        $books = Book::all();
        
        return Inertia::render('Stores/Create', [
            'books' => $books
        ]);
    }

    public function edit(Request $request) {
        $store = Store::with('books')->find($request->id);
        $books = Book::all();

        return Inertia::render('Stores/Edit', [
            'store' => $store,
            'books' => $books,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'active' => 'required|boolean',
            'image' => 'mimes:jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('image')->storeAs('public/stores', $request->file('image')->getClientOriginalName());
        $url = Storage::url($path);

        $store = Store::create([
            'name' => $request->name,
            'address' => $request->address,
            'active' => $request->active,
            'description' => $request->description,
            'image_url' => $url,
        ]);

        if ($request->has('books')) {
            $store->books()->attach($request->books);
        }

        return Redirect::route('stores')->with('success', 'Store created successfully');
    }

    public function read(Request $request) {
        $store = Store::with('books')->find($request->id);

        return Inertia::render('Stores/Read', [
            'store' => $store
        ]);
    }

    public function update(Request $request) {
        $store = Store::with('books')->find($request->id);

        if ($request->hasFile('image')) {
            Storage::delete($store->image_url);
            $path = $request->file('image')->storeAs('public/stores', $request->file('image')->getClientOriginalName());
            $url = Storage::url($path);
        } else {
            $url = $store->image_url;
        }

        $store->update([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'active' => $request->active,
            'image_url' => $url,
        ]);

        $store->books()->sync($request->books);

        return Redirect::route('stores')->with('success', 'Store updated successfully');
    }

    public function delete(Request $request) {
        $store = Store::find($request->id);
 
        if($store) {
            Storage::delete($store->image_url);

            $store->delete();

            return Redirect::route('stores')->with('success', 'Store deleted successfully');
        }

        return Redirect::route('stores')->with('error', 'Store delete error');
    }

    public function deleteBooks(Request $request) {

        $store = Store::find($request->id);
        $store->books()->detach($request->bookId);

        return $store;
    }
}
