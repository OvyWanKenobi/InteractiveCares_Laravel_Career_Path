<?php

namespace App\Http\Controllers;

use  App\Http\Controllers\PostController;
use App\Http\Requests\EditProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;
use App\Services\PostService;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {

        $posts = PostService::getAllPosts();

        if (!$posts) {
            return redirect()->route('home')->withErrors(['error' => 'Error in loading Post']);
        }
        // dd($posts);
        return  view('user.index', compact('posts'));
    }

    public function profile()
    {

        $user = auth()->user()->only(['fullname', 'bio']);


        return  view('user.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = auth()->user()->only(['firstname', 'lastname', 'bio', 'email',]);
        // dd($user);
        return  view('user.edit-profile', compact('user'));
    }

    public function editProfileSubmit(EditProfileRequest $request)
    {

        $validated = $request->validated();

        // dd($validated);
        
        if (!Hash::check($validated['current-password'], auth()->user()->password)) {
            return redirect()->back()->withErrors(['current-password' => 'Your current password is incorrect.']);
        }

        $updated = $this->userService->updateProfile($validated);

        if (!$updated) {
            return redirect()->back()->withErrors(['error' => 'Error occurred while updating profile. Please try again.']);
        }

        return redirect('edit-profile')->with('message', 'Updated Successfully');
    }
}
