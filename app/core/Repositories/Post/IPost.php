<?php

namespace App\Core\Repositories\Post;

interface IPost {
    public function getCategoryofPost();
    public function findBySlug($slug);
}