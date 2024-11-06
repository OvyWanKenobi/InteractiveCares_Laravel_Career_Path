<?php

use App\Http\Controllers\Web;

use Illuminate\Support\Facades\Route;


// Route::get('/{link:short_url_code}', [Web\V1\LinkController::class, 'visitShortLink']);

Route::get('/{link:short_url_code}', [Web\V2\LinkController::class, 'visitShortLink']);
