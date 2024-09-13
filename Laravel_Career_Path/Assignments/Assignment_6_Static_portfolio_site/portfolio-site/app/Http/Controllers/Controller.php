<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $myInfo;

    public function __construct()
    {
        $myInfo = Storage::disk('data')->get('my-info.json');
        $this->myInfo = json_decode($myInfo);

        view()->share('myInfo', $this->myInfo);
    }
}
