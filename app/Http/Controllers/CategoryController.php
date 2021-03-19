<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Repositories\Category\ICategory;
use App\Models\Categories;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(ICategory $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index() {
        $category = $this->categoryRepository->getPostofCategory();
        return $category;
    }
    public function show($slug) {
        $item = $this->categoryRepository->findBySlug($slug);
        return view('pages.categories.category', ['posts' => $item->post, 'category' => $item]);
    }
    public function store(Request $request) {
        return 'aaa';
        // $item = $this->categoryRepository->create($request->all());
        // return $item;
    }


}
