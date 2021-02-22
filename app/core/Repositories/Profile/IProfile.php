<?php

namespace App\Core\Repositories\Profile;

interface IProfile {
    public function getPostPublished($post);
    public function getPostUnPublished($post);
    public function moveFile($request);
    public function saveFile($id);
    public function findUserBySlug($slug);
    public function editProfile($slug);
}