<?php

namespace App\Core\Repositories\Post;


use App\core\Repositories\EloquentRepositories;
use App\core\Repositories\Post\IPost;
use App\Models\Post;

class PostImpl extends EloquentRepositories implements IPost {
    public function getModel() {
        return \App\Models\Post::class;
    }
    
    public function findBySlug($slug) {
        $post = $this->_model::where('slug', '=' ,$slug)->firstOrFail();
        return $post;
    }

    public function getPublished() {
        $post = Post::Published()->get();
        return $post;
    }
    public function getUnPublish() {
        $post = Post::UnPublish()->get();
        return $post;
    }
    public function publish($id) {
        $post = Post::find($id);
        $post->published = 1;
        $post->save();
    }
    public function unPublish($id) {
        $post = Post::find($id);
        $post->published = 0;
        $post->save();
    }
    public function upPoint($id) {
        $post = Post::find($id);
        $post->point = $post->point + 1;
        $post->save();
        return $post->point;
    }
    public function downPoint($id){
        $post = Post::find($id);
        $post->point = $post->point - 1;
        if($post->point < 0) {$post->point = 0;}
        $post->save();
        return $post->point;
    }
}
