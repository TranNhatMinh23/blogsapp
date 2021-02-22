<?php

namespace App\Core\Repositories\Post;

interface IPost {
    public function findBySlug($slug);
    public function getPublished();
    public function getUnPublish();
    public function publish($id);
    public function unPublish($id);
    public function upPoint($id);
    public function downPoint($id);
}