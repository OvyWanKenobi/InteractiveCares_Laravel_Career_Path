<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function getPostImageFileAttribute()
    {

        if ($this->postimage && Storage::disk('local')->exists('post-images/' . $this->postimage)) {

            return route('get-local-photo', ['filePath' => 'post-images/' . $this->postimage]);
        }

        return '';
    }
}
