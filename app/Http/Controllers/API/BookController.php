<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(){

        try {
            $books = Book:: all();
            return response()->json([
                'status' => '201',
                'message' => 'success',
                'books' => $books
            ], 201);
       } catch (Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => 'Request Failed',
                // 'message' => $e->getMessage(),
            ], 500);
       }

    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:150',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'publisher' => 'required|max:100',
            'city' => 'required|max:75',
            'quantity' => 'required|numeric',
            'bookshelf_id' => 'required',
            'cover' => 'nullable|image',
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->storeAs(
                'public/cover_buku',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }

        $book = Book::create($validated);

        return response()->json([
            'status' => '201',
            'message' => 'buku berhasil ditambahkan',
            'book' => $book,
        ], 201);
    } catch (Exception $e) {
        return response()->json([
            'status' => '500',
            'message' => 'Request Failed',
            'message' => $e->getMessage(),
        ], 500);
    }
}

public function update(Request $request, string $id)
{
    try {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => '404',
                'message' => 'Buku tidak ditemukan',
            ], 404);
        }

        if ($request->method() == 'PUT') {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'author' => 'required|max:150',
                'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
                'publisher' => 'required|max:100',
                'city' => 'required|max:75',
                'quantity' => 'required|numeric',
                'bookshelf_id' => 'required',
                'cover' => 'nullable|image',
            ]);
        } else {
            $validated = $request->validate([
                'title' => 'sometimes|required|max:255',
                'author' => 'sometimes|required|max:150',
                'year' => 'sometimes|required|digits:4|integer|min:1900|max:' . (date('Y')),
                'publisher' => 'sometimes|required|max:100',
                'city' => 'sometimes|required|max:75',
                'quantity' => 'sometimes|required|numeric',
                'bookshelf_id' => 'sometimes|required',
                'cover' => 'nullable|image',
            ]);
        }

        if ($request->hasFile('cover')) {
            if ($book->cover != null) {
                Storage::delete('public/cover_buku/' . $request->old_cover);
            }

            $path = $request->file('cover')->storeAs(
                'public/cover_buku',
                'cover_buku_' . time() . '.' . $request->file('cover')->extension()
            );
            $validated['cover'] = basename($path);
        }

        Book::where('id', $id)->update($validated);
        $res = Book::find($id);

        return response()->json([
            'status' => '201',
            'message' => 'Buku berhasil diubah',
            'book' => $res,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'status' => '500',
            'message' => 'Gagal mengubah buku',
            'error' => $e->getMessage(),
        ], 500);
    }
}


public function destroy(string $id)
{
    try {
        $book = Book::findOrFail($id);
        Storage::delete('public/cover_buku/' . $book->cover);

        $book->delete();

        return response()->json([
            'status' => '201',
            'message' => 'Buku berhasil dihapus',
            'book' => $book,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'status' => '500',
            'message' => 'Gagal menghapus buku',
            'error' => $e->getMessage(),
        ], 500);
    }
}

}
