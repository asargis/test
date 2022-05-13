<?php

namespace App\Services;

use App\Contracts\RatingServiceInterface;
use App\Jobs\IncrementLike;
use App\Jobs\IncrementView;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleRatingService implements RatingServiceInterface
{
    private int $articleId;

    public function __construct(int $articleId)
    {
        $this->articleId = $articleId;
    }

    public function like(): int
    {
        Cache::tags(['likes'])->has($this->articleId) ? Cache::tags(['likes'])->increment($this->articleId) : Cache::tags(['likes'])->put($this->articleId, 1);

        $likesCount = Cache::tags(['likes'])->get($this->articleId);
        IncrementLike::dispatch($this->articleId, $likesCount);
        return $likesCount;
    }

    public function view(): int
    {
        Cache::tags(['views'])->has($this->articleId) ? Cache::tags(['views'])->increment($this->articleId) : Cache::tags(['views'])->put($this->articleId, 1);

        $viewsCount = Cache::tags(['views'])->get($this->articleId);
        IncrementView::dispatch($this->articleId, $viewsCount);
        return $viewsCount;
    }

    public function likesCount(): int
    {
        return Article::where('id', $this->articleId)
            ->pluck('likes_count')->first();
    }

    public function viewsCount(): int
    {
        return Article::where('id', $this->articleId)
            ->pluck('views_count')->first();
    }
}
