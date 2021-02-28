<?php

namespace App\Core\Repositories\Profile;

use App\Core\Repositories\EloquentRepositories;
use App\Core\Repositories\Profile\IProfile;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileImpl extends EloquentRepositories implements IProfile {
    private $avarta;
    public function getModel() {
        return \App\Models\Profile::class;
    }
    public function moveFile($request) {
        $file = $request->avarta;
        $file_name = $file->getClientOriginalName();
        $file->move('images', $file_name);
        $this->avarta = $file_name;
        return true;
    }
    public function saveAvarta($id, $request) {
        $profile = Profile::find($id);
        $profile->avarta = $request->avarta->getClientOriginalName();
        $profile->save();
    }

    public function findUserBySlug($slug) {
        $user = User::where('slug', '=', $slug)->firstOrFail();
        return $user;
    }
    public function getPostPublished($slug) {
        $user = $this->findUserBySlug($slug);
        $postsPublished = $user->posts->where('published', '=', '1');
        return $postsPublished;
    }

    public function getPostUnPublished($slug) {
        $user = $this->findUserBySlug($slug);
        $postsUnpublish = $user->posts->where('published', '=', '0');
        return $postsUnpublish;
    }
    
    public function editProfile($slug) {
        $user = User::where('slug', '=', $slug)->firstOrFail();
        $profile = $user->profile;
        return $profile;
    }
    
}
