<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Link;
use Illuminate\Support\Str;

class LinkService
{
    public function shortenUrl(string $url)
    {

        try {
            $linkExist = Link::where('long_url', $url)->first();

            if ($linkExist) {
                return $linkExist->short_url_code;
            };

            do {
                $shortUrlCode = Str::random(8);
            } while (Link::where('short_url_code', $shortUrlCode)->exists());


            $link = new Link();
            $link->long_url = $url;
            $link->short_url_code = $shortUrlCode;
            $link->save();

            $user = auth()->user();
            $user->links()->attach($link->id);

            return $shortUrlCode;
        } catch (\Exception $e) {
            return false;
        }
    }
}
