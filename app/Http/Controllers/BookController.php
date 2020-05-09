<?php


namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="Books API", version="0.1")
 */

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/books",
     *     @OA\Response(response="200", description="All books")
     * )
     */
    public function showAllBooks()
    {
        return response()->json(Book::all());
    }

    /**
     * @OA\Get(
     *     path="/api/book/{id}",
     *     operationId="findBookById",
     *     @OA\Parameter(
     *      in="path",
     *      name="id",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *      )
     *     ),
     *     @OA\Response(response="200", description="All books")
     * )
     */
    public function showBook($id)
    {
        return response()->json(Book::query()->find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'isbn' => 'required|unique:books',
            'numberOfPages' => 'required|integer',
        ]);
        $book = Book::query()->create($request->json()->all());
        return response()->json($book, 201);
    }

    public function update($id, Request $request)
    {
        $book = Book::query()->findOrFail($id);
        $book->update($request->json()->all());

        return response()->json($book, 200);
    }

    public function delete($id)
    {
        Book::query()->findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}
