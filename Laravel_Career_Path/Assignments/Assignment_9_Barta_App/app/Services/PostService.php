<?php

namespace App\Services;

use App\Models\Comment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public static function getAllPosts()
    {

        try {

            $posts = Post::with(['user'])
                ->withCount('comments')
                ->orderByDesc('created_at')
                ->get();

            // dd($posts);

            return $posts;
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function getAllPostsByUser(User $user)
    {

        try {

            $postsByUser = Post::where('user_id', $user->id)
                ->withCount('comments')
                ->orderByDesc('created_at')
                ->get();

            $commentsCountByUser = Comment::where('user_id', $user->id)
                ->count();

            // dd($postsByUser);


            return [$postsByUser, $commentsCountByUser];
        } catch (\Exception $e) {
            return [];
        }
    }



    public function getPostById($id)
    {


        try {

            $post = Post::with('comments.user', 'user')->find($id);

            $post->comments = $post->comments->sortByDesc('created_at');

            return $post;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function storePost($data, $userId)
    {

        try {

            $post = new Post();
            $post->user_id = $userId;
            $post->content = $data['barta-post'];
            $post->views = 0;


            if (isset($data['postimage']) && !empty($data['postimage'])) {

                $filename = Str::random(10) . '.png';
                Storage::disk('local')->put('post-images/' . $filename, file_get_contents($data['postimage']));
                $post->postimage = $filename;
            }

            $post->save();


            return $post;
        } catch (Exception $e) {
            dd($e);
            return false;
        }
    }

    public function updatePost($id, $userId, $postContent)
    {

        try {

            $post = Post::where('id', $id)
                ->where('user_id', $userId)
                ->update([
                    'content' => $postContent,
                    'updated_at' => now(),
                ]);


            return $post;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deletePost($id, $userId)
    {
        try {

            $post = Post::where([
                'id' => $id,
                'user_id' => $userId
            ])->first();

            $filename = $post->postimage;

            $deleted = $post->delete();

            if ($deleted && Storage::disk('local')->exists('post-images/' . $filename)) {

                Storage::disk('local')->delete('post-images/' . $filename);
            }

            return $deleted;
        } catch (Exception $e) {
            return false;
        }
    }


    public function search($search)
    {
        try {
            $posts = Post::with('User')
                ->withCount('comments')
                ->when($search, function ($query, $search) {
                    return $query->where('content', 'Like', '%' . $search . '%')
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->where('username', 'LIKE', '%' . $search   . '%')
                                ->orWhere('firstname', 'LIKE', '%' . $search . '%')
                                ->orWhere('lastname', 'LIKE', '%' . $search . '%')
                                ->orWhere('email', 'LIKE', '%' . $search . '%');
                        });
                })
                ->orderByDesc('created_at')
                ->get();


            return $posts;
        } catch (Exception $e) {
            return false;
        }
    }
}
