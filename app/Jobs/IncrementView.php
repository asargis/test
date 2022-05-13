<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class IncrementView implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $articleId;

    private int $viewsCount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $articleId, int $viewsCount)
    {
        $this->articleId = $articleId;
        $this->viewsCount = $viewsCount;
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
            ->update(['views_count' => $this->viewsCount]);
    }
}
