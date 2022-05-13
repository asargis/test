<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class IncrementLike implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $articleId;

    private int $likesCount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $articleId, int $likesCount)
    {
        $this->articleId = $articleId;
        $this->likesCount = $likesCount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('articles')
            ->where('id', $this->articleId)
            ->update(['likes_count' => $this->likesCount]);
    }
}
