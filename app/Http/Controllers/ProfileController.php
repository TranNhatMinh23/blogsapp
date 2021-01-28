<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Profile;
use Auth;
use App\Core\Plugins\ResizeImage;

class ProfileController extends Controller
{
    public function index($slug) {
        $user = User::where('slug', '=', $slug)->firstOrFail();
        return view('pages.profile.profile',['user' => $user]);
    }
    public function store() {
        
    }
    public function uploadfile($file) {

    }
    public function edit($slug) {
        $user = User::where('slug', '=', $slug)->firstOrFail();
        $profile = $user->profile;
        return view('pages.profile.editProfile', ['profile' => $profile]);
    }

    public function update($id, Request $request) {
        // dd($request);
        $file_name = $request->file('avarta')->getClientOriginalName();
        $file = $request->avarta;
        
        $file->move('images', $file_name);

        $profile = Profile::find($id);
        $profile->avarta = $file_name;
        $profile->user_id = Auth::id();
        $profile->save();

        // echo Auth::id();
        return redirect(route('profile.index', Auth::user()->slug));
    }
}
