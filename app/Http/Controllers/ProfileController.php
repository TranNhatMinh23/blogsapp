<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Core\Plugins\ResizeImage;
use App\Core\Repositories\Profile\IProfile;
class ProfileController extends Controller
{
    protected $profileRepository;
    public function __construct(IProfile $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function index($slug) {
        
        $user = User::where('slug', '=', $slug)->firstOrFail();
        $postsPublished = $user->posts->where('published', '=', '1');

        $postsPublished = $this->profileRepository->getPostPublished($slug);
        $postsUnpublish = $this->profileRepository->getPostUnPublished($slug);
        $user = $this->profileRepository->findUserBySlug($slug);
        
        return view('pages.profile.profile',[
            'user' => $user,
            'postsPublished' => $postsPublished,
            'postsUnpublish' => $postsUnpublish,
        ]);
    }

    public function edit($slug) {
        $profile = $this->profileRepository->editProfile($slug);
        return view('pages.profile.editProfile', ['profile' => $profile]);
    }

    public function update($id, Request $request) {
        $this->profileRepository->moveFile($request);
        // $this->profileRepository->saveFile($id);
        $request->avarta = 'avarta_default.png';
        $this->profileRepository->update($id, $request->all());
        return redirect(route('profile.index', Auth::user()->slug));
    }

    
}
