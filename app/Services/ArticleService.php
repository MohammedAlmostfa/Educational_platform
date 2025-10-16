<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Log;

/**
 * ArticleService
 *
 * This service provides CRUD operations for articles
 * and returns unified responses with status and message in Arabic.
 */
class ArticleService
{
    /**
     * Retrieve all articles with pagination.
     *
     * @return array Unified response with status, message, and data
     */
    public function getAllArticles($searchData)
{

    // Apply filters only if $filters is not empty, then paginate
    $articles = Article::with('media')
        ->when(!empty($searchData), function ($query) use ($searchData) {
             $query->search($searchData);
        })
        ->get();

    return [
        'status'  => 200,
        'message' => 'تم استرجاع جميع المقالات بنجاح',
        'data'    => $articles
    ];
}


    /**
     * Create a new article and optionally upload a photo.
     *
     * @param array $data Article data including optional 'photo'
     * @return array Unified response with status, message, and created article
     */
    public function createArticle(array $data)
    {
        // Create article record in the database
        $article = Article::create($data);

        // Handle optional photo upload
        if (!empty($data['photo'])) {
            $article->storeMediaFile($data['photo'], 'articles/photos', true);
        }

        return [
            'status'  => 200,
            'message' => 'تم إنشاء المقال بنجاح',

        ];
    }

    /**
     * Update an existing article and optionally update its photo.
     *
     * @param Article $article Article model instance
     * @param array $data Updated data including optional 'photo'
     * @return array Unified response with status, message, and updated article
     */
    public function updateArticle(Article $article, array $data)
    {
        // Update article data
        $article->update($data);

        // Handle optional photo update
        if (!empty($data['photo'])) {
             // Delete related media files if exist
        $article->media()->delete();
     $article->deleteMedia($article->media);
        // Delete the article record itself
        $article->delete();
            $article->storeMediaFile($data['photo'], 'articles/photos', true);
        }

        return [
            'status'  => 200,
            'message' => 'تم تحديث المقال بنجاح',

        ];
    }

    /**
     * Delete an article along with its media.
     *
     * @param Article $article Article model instance
     * @return array Unified response with status, message, and null data
     */
    public function deleteArticle(Article $article)
    {
        // Delete related media files if exist
        $article->media()->delete();
     $article->deleteMedia($article->media);
        // Delete the article record itself
        $article->delete();

        return [
            'status'  => 200,
            'message' => 'تم حذف المقال بنجاح',
            'data'    => null,
        ];
    }
}
