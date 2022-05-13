<?php

namespace App\Http\Controllers;

use App;
use App\DataTransferObjects\CommentData;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Article;
use App\Services\ArticleRatingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ArticleMiniResource;
use Nette\Schema\ValidationException;


class ArticleController extends Controller
{
    public function index()
    {
        return ArticleMiniResource::collection(Article::orderBy('created_at', 'desc')->paginate(10));
    }

    public function last(): ResourceCollection
    {
        return ArticleMiniResource::collection(Article::latest()->take(6)->get());
    }

    public function article(string $slug)
    {
        return Article::where('slug', $slug)->with('tags')->get();
    }

    public function like(Request $request): JsonResponse
    {
        $articleId = $request->article_id;
        $articleRatingService = App::make(ArticleRatingService::class, ['articleId' => $articleId]);
        $likesCount = $articleRatingService->like($articleId);

        return new JsonResponse([
            'likes_count' => $likesCount,
        ]);
    }

    public function view(Request $request): JsonResponse
    {
        $articleId = $request->article_id;
        $articleRatingService = App::make(ArticleRatingService::class, ['articleId' => $articleId]);
        $viewsCount = $articleRatingService->view();

        return new JsonResponse([
            'views_count' => $viewsCount,
        ]);
    }

    public function comment(CreateCommentRequest $request)
    {
        try {
            $validated = $request->validated();
            $commentData = new CommentData([
                    "subject" => $validated['subject'],
                    "body" => $validated['body'],
                    "article_id" => $request['article_id'],
                ]
            );
            $commentService = App::make(App\Services\ArticleCommentService::class);
            $commentService->comment($commentData);

            return response('Комментарий успешно сохранен', 200);
        } catch (ValidationException $exception) {
            return response($exception->getMessage(), $exception->getCode());
        }
    }

    public function likes(Request $request): JsonResponse
    {
        $articleId = $request->article_id;

        $articleRatingService = App::make(ArticleRatingService::class, ['articleId' => $articleId]);
        $likesCount = $articleRatingService->likesCount();
        return new JsonResponse([
            'likes_count' => $likesCount,
        ]);
    }

    public function views(Request $request): JsonResponse
    {
        $articleId = $request->article_id;

        $articleRatingService = App::make(ArticleRatingService::class, ['articleId' => $articleId]);
        $viewsCount = $articleRatingService->viewsCount();
        return new JsonResponse([
            'views_count' => $viewsCount,
        ]);
    }

}
