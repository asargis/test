<?php

namespace App\Contracts;

use App\DataTransferObjects\CommentData;

interface CommentServiceInterface
{
    public function comment(CommentData $comment);
}
