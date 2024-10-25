<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {

        $validated = $request->validated();
        $comment = $validated['comment'];
        $postId = $request->postId;


        $comment = $this->commentService->storeComment($comment, auth()->user()->id, $postId);

        if ($comment) {
            return redirect()->route('posts.show', ['post' => $postId]);
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = $this->commentService->getCommentById($id);

        if ($comment && $comment->user_id === auth()->user()->id) {
            return view('user.posts.edit-comment', compact('comment'));
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, $id)
    {
        $validated = $request->validated();
        $comment = $validated['comment'];

        $updated = $this->commentService->updateComment($id, auth()->user()->id, $comment);

        // dd($updated);

        if ($updated) {
            return redirect()->route('posts.show', ['post' => $request->postId])->with('message', 'Comment Updated Successfully');
        }

        return redirect()->route('posts.show', ['post' => $request->postId])->withErrors(['error' => 'Something went wrong. Could not update comment']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->commentService->deleteComment($id, auth()->user()->id);

        if ($deleted) {
            return redirect()->back()->with('message', 'Comment Deleted Successfully');
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong.']);
    }
}
