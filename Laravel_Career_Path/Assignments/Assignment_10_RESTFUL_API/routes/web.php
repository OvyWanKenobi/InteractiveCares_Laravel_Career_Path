<?php

use App\Http\Controllers\Web;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/docs/api#/');
});


// Route::get('/{link:short_url_code}', [Web\V1\LinkController::class, 'visitShortLink']);

Route::get('/{link:short_url_code}', [Web\V2\LinkController::class, 'visitShortLink']);



