<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class PostService
{
    public static function getAllPosts()
    {
        try {
            $posts = DB::table('posts')
                ->join('users', 'user_id', '=', 'users.id')
                ->select('posts.*', 'users.fullname', 'users.username', 'users.profilepicture')
                ->orderByDesc('created_at')
                ->get();

            $posts->map(function ($post) {
                $post->created_at = Carbon::make($post->created_at);
                $post->updated_at = Carbon::make($post->updated_at);
            });

            return $posts;
        } catch (Exception $e) {
            return false;
        }
    }

    public function storePost($postContent, $userId)
    {
        try {
            return DB::table('posts')->insertGetId([
                'user_id' => $userId,
                'content' => $postContent,
                'views' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getPostById($id)
    {
        $post = DB::table('posts')
            ->where('posts.id', $id)
            ->join('users', 'user_id', '=', 'users.id')
            ->select('posts.*', 'users.fullname', 'users.username', 'users.profilepicture')
            ->first();

        if ($post) {
            $post->created_at = Carbon::make($post->created_at);
            $post->updated_at = Carbon::make($post->updated_at);
        }

        return $post;
    }

    public function updatePost($id, $userId, $postContent)
    {
        try {
            return DB::table('posts')
                ->where([
                    'posts.id' => $id,
                    'user_id' => $userId
                ])
                ->update([
                    'content' => $postContent,
                    'updated_at' => now(),
                ]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function deletePost($id, $userId)
    {
        try {
            return DB::table('posts')
                ->where([
                    'posts.id' => $id,
                    'user_id' => $userId
                ])
                ->delete();
        } catch (Exception $e) {
            return false;
        }
    }
}
