<?php

namespace App\Jobs;

use App\DataTransferObjects\CommentData;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArticleCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private CommentData $commentData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CommentData $commentData)
    {
        $this->commentData = $commentData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = new Comment($this->commentData->toArray());
        $comment->save();
    }
}
