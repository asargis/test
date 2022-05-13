<?php

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class CommentData extends DataTransferObject
{
    public string $subject;
    public string $body;
    public int $article_id;
}
