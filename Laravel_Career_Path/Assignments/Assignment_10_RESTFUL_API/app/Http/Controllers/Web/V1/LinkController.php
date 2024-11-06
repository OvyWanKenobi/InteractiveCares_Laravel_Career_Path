<?php

namespace App\Http\Controllers\Web\V1;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController
{

    public function visitShortLink(Link $link)
    {
        // dd($link);

        return redirect($link->long_url);
    }
}
