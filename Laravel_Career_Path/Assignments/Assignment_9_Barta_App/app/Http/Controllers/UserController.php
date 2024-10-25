<?php

namespace App\Http\Controllers;

use  App\Http\Controllers\PostController;
use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Services\UserService;
use App\Services\PostService;
use Illuminate\Support\Facades\File;

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


        // dd($posts);
        return  view('user.index', compact('posts'));
    }

    public function profile(User $user)
    {

        [$postsByUser, $commentsCountByUser] = PostService::getAllPostsByUser($user);

        // dd([$postsByUser, $commentsCountByUser]);

        return  view('user.profile', compact('postsByUser', 'commentsCountByUser', 'user'));
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

        

        if (!Hash::check($validated['current-password'], auth()->user()->password)) {
            return redirect()->back()->withErrors(['current-password' => 'Your current password is incorrect.']);
        }

        $updated = $this->userService->updateProfile($validated);

        if (!$updated) {
            return redirect()->back()->withErrors(['error' => 'Error occurred while updating profile. Please try again.']);
        }

        return redirect('edit-profile')->with('message', 'Updated Successfully');
    }

    public function getLocalPhoto(string $filePath)
    {

        $path = storage_path('app/' . $filePath);

        if (!File::exists($path)) {
            // abort(404);
            dd($path);
        }

        return response()->file($path);
    }
}
