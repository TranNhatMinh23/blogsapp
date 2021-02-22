<?php

namespace App\Core\Repositories\Comment;

use App\Core\Repositories\EloquentRepositories;
use App\Core\Repositories\Post\IPost;

class CommentImpl extends EloquentRepositories implements IComment {
    public function getModel() {
        return \App\Models\Comment::class;
    }
    public function orderById() {
        $post = $this->_model::orderBy('id', 'ESC')->get();
        return $post;
    }
}
