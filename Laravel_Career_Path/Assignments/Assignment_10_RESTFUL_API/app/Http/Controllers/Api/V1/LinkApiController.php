<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Services\LinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkApiController
{
    protected $linkService;
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    public function getUserLinks(Request $request)
    {
        $links = auth()->user()->links;

        return LinkResource::collection($links);
    }

    public function shortener(Request $request)
    {
        $request->validate([
            'url' => ['required', 'url'],
        ]);

        $shortUrlCode = $this->linkService->shortenUrl($request->url);

        if ($shortUrlCode === false) {
            return response()->json([
                'error' => 'An error occurred .',
            ], 500);
        }

        return response()->json([
            'short_url' => 'http://localhost:8000/' . $shortUrlCode,
        ], 200);
    }
}
