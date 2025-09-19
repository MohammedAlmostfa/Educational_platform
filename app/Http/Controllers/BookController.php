<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookRequest\StoreBookRequest;
use App\Http\Requests\BookRequest\BookFilterRequest;
use App\Http\Requests\BookRequest\UpdateBookRequest;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of books.
     */
    public function index(BookFilterRequest $request)
    {
        $validatedData=$request->validated();
        $result = $this->bookService->getAllBooks($validatedData);

        return $result['status'] === 200
            ? self::paginated ($result['data'],BookResource::class, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Store a newly created book.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $result = $this->bookService->createBook($data);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        return response()->json([
            'status' => 200,
            'message' => 'تم جلب الكتاب بنجاح',
            'data' => $book->load('media'),
        ], 200);
    }

    /**
     * Update the specified book.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated();
        $result = $this->bookService->updateBook($book, $data);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Remove the specified book.
     */
    public function destroy(Book $book)
    {
        $result = $this->bookService->deleteBook($book);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
