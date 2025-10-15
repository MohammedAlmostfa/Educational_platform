<?php


namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ArticalResource;
use App\Http\Resources\ArticleResource;
use App\Http\Requests\ArticalRequest\StoreArticleRequest;
use App\Http\Requests\ArticalRequest\ArticleFilterRequest;
use App\Http\Requests\ArticalRequest\UpdateArticleRequest;

/**
 * ArticleController
 *
 * This controller manages CRUD operations for articles.
 * It uses ArticleService for business logic.
 */
class ArticleController extends Controller
{
    protected $articleService;

    /**
     * ArticleController constructor.
     *
     * @param ArticleService $articleService Service for managing articles
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         $searchData = $request->input('search');
        $result = $this->articleService->getAllArticles($searchData);

        return $result['status'] === 200
            ? self::success(ArticleResource::collection($result['data']), $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request Validated request for storing an article
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreArticleRequest $request)
    {
        $validatedData = $request->validated();

        $result = $this->articleService->createArticle($validatedData);
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleRequest $request Validated request for updating an article
     * @param Article $article Article model instance
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validatedData = $request->validated();

        $result = $this->articleService->updateArticle($article, $validatedData);
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article Article model instance
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article)
    {
        $result = $this->articleService->deleteArticle($article);
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
