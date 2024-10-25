<?php

namespace App\Services;

use App\Models\Comment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;

class CommentService
{

    public function getCommentById($id)
    {
        try {

            $comment = Comment::with('user')->find($id);

            return $comment;
        } catch (\Exception $e) {
            return [];
        }
    }



    public function storeComment($commentBody, $userId, $postId)
    {

        try {

            $comment = new Comment();
            $comment->user_id = $userId;
            $comment->comment = $commentBody;
            $comment->post_id = $postId;
            $comment->save();

            // dd($post);
            return $comment;
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateComment($id, $userId, $commentBody)
    {

        try {

            $comment = Comment::where('id', $id)
                ->where('user_id', $userId)
                ->update([
                    'comment' => $commentBody,
                    'updated_at' => now(),
                ]);


            return $comment;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteComment($id, $userId)
    {
        try {


            $deleted =  Comment::where([
                'id' => $id,
                'user_id' => $userId
            ])->delete();

            // dd($deleted);

            return $deleted;
        } catch (Exception $e) {
            return false;
        }
    }
}
