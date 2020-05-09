<?php


namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showAllBooks()
    {
        return response()->json(Book::all());
    }

    public function showBook($id)
    {
        return response()->json(Book::query()->find($id));
    }

    public function update($id, Request $request)
    {
        $book = Book::query()->findOrFail($id);
        $book->update($request->all());

        return response()->json($book, 200);
    }

    public function delete($id)
    {
        Book::query()->findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
