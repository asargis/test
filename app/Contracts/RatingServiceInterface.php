<?php

namespace App\Contracts;

interface RatingServiceInterface
{
    public function like(): int;
    public function view(): int;
    public function likesCount(): int;
    public function viewsCount(): int;
}
