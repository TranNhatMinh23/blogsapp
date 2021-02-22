<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Repositories\Post\IPost;
class HomeController extends Controller
{
    protected $postRepository;
    public function __construct(IPost $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        
        $posts = $this->postRepository->getPublished()->sortByDesc('id');
        return view('pages.home', ['posts' => $posts]);
    }
}
