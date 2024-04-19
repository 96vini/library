<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Book;

class SiteController extends Controller
{
    public function index()
    {
        $books = Book::with('stores')->get();
        return Inertia::render('Dashboard', compact('books'));
    }
}
