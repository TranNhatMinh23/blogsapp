<?php

namespace App\Core\Repositories\Category;

use App\Core\Repositories\EloquentRepositories;
use App\Core\Repositories\Category\ICategory;
use App\Models\Categories;

class CategoryImpl extends EloquentRepositories implements ICategory {
    public function getModel() {
        return \App\Models\Categories::class;
    }
    public function getPostofCategory() {
        $category = $this->_model::with('post')->get();
        return $category;
    }
    public function getCategoryByName($name) {
        $category = $this->_model::where('name','=', $name)->get();
        return $category;
    }
    public function findBySlug($slug) {
        $category = $this->_model::where('slug', '=', $slug)->firstOrFail();
        return $category;
    }
}
