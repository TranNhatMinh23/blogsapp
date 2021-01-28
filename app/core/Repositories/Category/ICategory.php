<?php

namespace App\Core\Repositories\Category;

interface ICategory {
    public function getPostofCategory();
    public function getCategoryByName($name);
    public function findBySlug($slug);
}