<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return Author::all();
    }

    public function show($id)
    {
        $author = Author::where('id', $id)->first();
        if ($author) {
            return response()->json([
                'message' => 'show author by id',
                'data' => $author
            ]);
        } else {
            return response()->json([
                'message' => 'author not found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'biography' => 'required'
        ]);

        $author = Author::create(
            $request->only(['name', 'gender', 'biography'])
        );

        return response()->json([
            'created' => true,
            'data' => $author
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        if ($author) {
            $author->fill(
                $request->only(['name', 'gender', 'biography'])
            );
            $author->save();
            return response()->json([
                'updated' => true,
                'data' => $author
            ], 200);
        } else {
            return response()->json([
                'message' => 'author not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $author = Author::find($id);
        if ($author) {
            $author->delete();
            return response()->json([
                'deleted' => true
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => 'author not found'
                ]
            ], 404);
        }
    }
}
