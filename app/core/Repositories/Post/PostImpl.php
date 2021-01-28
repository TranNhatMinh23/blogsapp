<?php

namespace App\Core\Repositories\Post;


use App\core\Repositories\EloquentRepositories;
use App\core\Repositories\Post\IPost;

class PostImpl extends EloquentRepositories implements IPost {
    public function getModel() {
        return \App\Models\Post::class;
    }
    public function getCategoryofPost() {
        $post = $this->_model::with('category')->get();
        return $post;
    }
    public function findBySlug($slug) {
        $post = $this->_model::where('slug', '=' ,$slug)->firstOrFail();
        return $post;
    }
}
