<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Repositories\Category\ICategory;
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
        $data = $request->all();
        
        // $item = $this->categoryRepository->create($data);
    }

    public function abc(Request $request) {
        echo 'ok nha';
    }
}
