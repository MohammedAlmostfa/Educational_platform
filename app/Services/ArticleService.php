<?php

namespace App\Services;

use App\Models\Article;

/**
 * ArticleService
 *
 * This service provides CRUD operations for articles
 * and returns unified responses with status and message in Arabic.
 */
class ArticleService
{
    /**
     * Retrieve all articles.
     *
     * @return array Unified response with status, message, and data
     */
    public function getAllArticles()
    {
        return [
            'status' => 200, // Response status code
            'message' => 'تم استرجاع جميع المقالات بنجاح', // Success message
            'data' => Article::paginate(10), // All articles from the database
        ];
    }

    /**
     * Create a new article.
     *
     * @param array $data Article data
     * @return array Unified response with status, message, and created article
     */
    public function createArticle(array $data)
    {
        $article = Article::create($data); // Create article in the database

        return [
            'status' => 200,
            'message' => 'تم إنشاء المقال بنجاح',
            'data' => $article, // Return the created article
        ];
    }

    /**
     * Update an existing article.
     *
     * @param Article $article Article model instance
     * @param array $data Updated data
     * @return array Unified response with status, message, and updated article
     */
    public function updateArticle(Article $article, array $data)
    {
        $article->update($data); // Update article data

        return [
            'status' => 200,
            'message' => 'تم تحديث المقال بنجاح',
            'data' => $article, // Return the updated article
        ];
    }

    /**
     * Delete an article.
     *
     * @param Article $article Article model instance
     * @return array Unified response with status, message, and null data
     */
    public function deleteArticle(Article $article)
    {
        $article->delete(); // Delete article from the database

        return [
            'status' => 200,
            'message' => 'تم حذف المقال بنجاح',
            'data' => null, // No data after deletion
        ];
    }
}
