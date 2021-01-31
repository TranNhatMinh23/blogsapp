<?php

namespace App\Core\Repositories\Post;

interface IPost {
    public function findBySlug($slug);
    public function getPublished();
    public function getUnPublish();
}