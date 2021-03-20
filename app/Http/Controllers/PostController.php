<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Repositories\Post\IPost;
use App\Core\Repositories\Comment\IComment;
use App\Core\Repositories\Category\ICategory;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreCommentRequest;

use Gate;
use App\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Profile;

class PostController extends Controller
{
    protected $postRepository;
    protected $commentRepository;
    protected $categoryRepository;

    public function __construct(IPost $postRepository, IComment $commentRepository, ICategory $categoryRepository) {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index() {
        $item = $this->postRepository->getAll()->sortByDesc('id');
        return $item;
    }
    public function show($slug) {
        $post = $this->postRepository->findBySlug($slug);
        $comments = $post->comment->sortByDesc('id');

        $post->view = $post->view + 1;
        $post->save();

        return view('pages.posts.post', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
    public function create() {
        $category = $this->categoryRepository->getAll();
        return view('pages.posts.createPost', ['category' => $category]);
    }

    public function store(Request $request) {
        $post = $this->postRepository->create($request->all()); 
        $post->category()->attach($request->categorySelect);
        return 'create success';
    }

    public function edit($slug) {
        $post = $this->postRepository->findBySlug($slug);
        $categories = $this->categoryRepository->getAll();
        
        return view('pages.posts.editPost', ['post' => $post, 'categories' => $categories]);
    }
    public function update($id, Request $request) {
        $this->postRepository->update($id, $request->all());
        $post = $this->postRepository->find($id);
        
        $post->category()->sync($request->categorySelect);
        $slug = $post->slug;
        // return redirect(route('post.show', $slug));
        return $slug;
    }
    public function destroy($id) {
        if($this->postRepository->delete((int)$id)) {
            return 'Delete success';
        };
        // return redirect()->back();
        
    }

    public function publishPost($id = null) {
        $this->postRepository->publish($id);
        return redirect(route('profile.index', Auth::user()->slug));
    }

    public function unpublishPost($id = null) {
       $this->postRepository->unPublish($id);
        return redirect(route('profile.index', Auth::user()->slug));
    }

    public function updateTimePost($id, Request $request) {
        $post = Post::find($id);
        $post->timePost = $request->timePost;
        $post->save();
        return $post;
    }

    public function storeComment(StoreCommentRequest $request) {
        $validated = $request->validated();
        
        $data = $request->all();
        $comment = $this->commentRepository->create($data);
        return $comment;
    }

    public function updateComment($id, Request $request){
        $comment = Comment::find($id);
        $comment->content =  $request->content;
        $comment->save();
        return $comment;
    }

    public function destroyComment($id) {
        $this->commentRepository->delete($id);
        return redirect()->back();
    }

    public function upPoint($id) {
        $post = $this->postRepository->upPoint($id);
        return $post;
    }
    public function downPoint($id) {
        $post = $this->postRepository->downPoint($id);
        if ($post < 0) {$post = 0;}
        return $post;
    }
}
