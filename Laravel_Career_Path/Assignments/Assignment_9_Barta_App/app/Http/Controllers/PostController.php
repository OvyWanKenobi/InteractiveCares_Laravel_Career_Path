<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
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
        

        $post = $this->postService->storePost($validated, auth()->user()->id);

        // dd($post);
        if ($post) {
            return redirect()->route('posts.show', ['post' => $post->id]);
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
            return redirect()->route('posts.show', ['post' => $id])->with('message', 'Post Updated Successfully');;
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
    }

    public function destroy($id)
    {
        $deleted = $this->postService->deletePost($id, auth()->user()->id);

        if ($deleted) {
            return redirect()->route('profile', ['user' => auth()->user()->username])->with('message', 'Post Deleted Successfully');
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
    }

    public function search(Request $request)
    {

        $search = $request->query('search');

        $posts = $this->postService->search($search);


        // dd($posts);

        return  view('user.index', compact('posts'));
    }
}
