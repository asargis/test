<?php

namespace App\Services;

use App\Contracts\CommentServiceInterface;
use App\DataTransferObjects\CommentData;
use App\Jobs\ArticleCommentJob;

class ArticleCommentService implements CommentServiceInterface
{

    public function comment(CommentData $comment): void
    {
        ArticleCommentJob::dispatch($comment);
    }
}
