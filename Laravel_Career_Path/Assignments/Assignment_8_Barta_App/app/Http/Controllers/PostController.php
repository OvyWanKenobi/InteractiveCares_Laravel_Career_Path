<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {

        return redirect()->route('home');
    }

    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $postContent = $validated['barta-post'];

        $postId = $this->postService->storePost($postContent, auth()->user()->id);

        if ($postId) {
            return redirect()->route('posts.show', ['post' => $postId]);
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);

        if ($post) {
            return view('user.posts.view-post', compact('post'));
        }

        return redirect()->route('home')->withErrors(['error' => 'Something went wrong.']);
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);

        if ($post && $post->user_id === auth()->user()->id) {
            return view('user.posts.edit-post', compact('post'));
        }

        return redirect()->route('home')->withErrors(['error' => 'Something went wrong.']);
    }

    public function update(PostRequest $request, $id)
    {
        $validated = $request->validated();
        $postContent = $validated['barta-post'];

        $updated = $this->postService->updatePost($id, auth()->user()->id, $postContent);

        if ($updated) {
            return redirect()->route('posts.show', ['post' => $id]);
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
    }

    public function destroy($id)
    {
        $deleted = $this->postService->deletePost($id, auth()->user()->id);

        if ($deleted) {
            return redirect()->route('home')->with('message', 'Post Deleted Successfully');
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
    }
}
