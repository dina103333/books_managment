<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Response;
use App\Http\Resources\BookResource;
use App\Http\Requests\StoreBookRequest;
use App\Traits\ApiResponse;

class BookController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $books = Book::paginate(10);
        return $this->successResponse(BookResource::collection($books), 'Books retrieved successfully');
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());
        return $this->successResponse(new BookResource($book), 'Book created successfully', Response::HTTP_CREATED);
    }


    public function show($id)
    {
        try {
            $book = Book::findOrFail($id);
            return $this->successResponse(new BookResource($book), 'Book retrieved successfully');
        } catch (\Exception $e) {
            return $this->notFoundResponse('Book not found.');
        }
    }
}
