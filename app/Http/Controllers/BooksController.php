<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        return Book::all();
    }

    public function show($id)
    {
        $book = Book::where('id', $id)->first();
        if ($book) {
            return response()->json([
                'data' => $book
            ]);
        } else {
            return response(
                'Book Not Found',
                404
            );
        }
    }
}
