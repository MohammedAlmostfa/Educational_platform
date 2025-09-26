<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

/**
 * BookService
 *
 * Service for managing Book entities (CRUD operations)
 * and handling associated media files.
 */
class BookService
{
    /**
     * Retrieve all books with their media using pagination.
     *
     * @return array Unified response with status, message, and data
     */
    public function getAllBooks($filters)
    {
        // Fetch books with related media (10 items per page)
        $books = Book::with('media')->when(!empty($filters), function ($query) use ($filters) {
            $query->filter($filters); // Use scopeFilter
        })
      ->get();
        return [
            'status'  => 200,
            'message' => 'تم استرجاع جميع الكتب بنجاح',
            'data'    => $books,

        ];
    }

    /**
     * Create a new book and optionally upload an associated file.
     *
     * @param array $data Book data (e.g., title, description, etc.)
     * @return array Unified response with status, message, and data
     */
    public function createBook(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Create book in the database
            $book = Book::create($data);

            // If a file is provided, store it
            if (!empty($data['file'])) {
                $book->storeMediaFile($data['file'], 'books/files', true);
            }

            return [
                'status'  => 200,
                'message' => 'تم إنشاء الكتاب بنجاح',

            ];
        });
    }

    /**
     * Update an existing book and optionally replace its media.
     *
     * @param Book $book The book instance to be updated
     * @param array $data Updated book data
     * @return array Unified response with status, message, and data
     */
    public function updateBook(Book $book, array $data)
    {
        return DB::transaction(function () use ($book, $data) {
            // Update book details
            $book->update($data);

            // If a new file is provided, replace the old one
            if (!empty($data['file'])) {
                $book->storeMediaFile($data['file'], 'books/files', true);
            }

            return [
                'status'  => 200,
                'message' => 'تم تحديث الكتاب بنجاح',

            ];
        });
    }

    /**
     * Delete a book along with all its associated media.
     *
     * @param Book $book The book instance to be deleted
     * @return array Unified response with status, message, and data
     */
    public function deleteBook(Book $book)
    {
        return DB::transaction(function () use ($book) {
            // Delete all related media
            $book->media()->delete();
            $book->deleteMedia($book->media);
            // Delete the book itself
            $book->delete();

            return [
                'status'  => 200,
                'message' => 'تم حذف الكتاب وجميع الملفات المرتبطة به بنجاح',
                'data'    => null,
            ];
        });
    }
}
