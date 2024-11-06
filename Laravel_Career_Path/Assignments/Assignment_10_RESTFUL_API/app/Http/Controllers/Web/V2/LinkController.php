<?php

namespace App\Http\Controllers\Web\V2;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController 
{

    public function visitShortLink(Link $link)
    {
        $link->increment('visits'); //added for v2

        return redirect($link->long_url);
    }
}
