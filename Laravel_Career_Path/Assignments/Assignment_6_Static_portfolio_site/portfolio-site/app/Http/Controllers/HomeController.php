<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function index()
    {

        // $services = Storage::disk('data')->json('home-services.json');
        $services = Storage::disk('data')->get('home-services.json'); //laravel 10
        $services = json_decode($services);
        // dd($services);


        $skills = Storage::disk('data')->get('home-skills.json');
        $skills = json_decode($skills);


        // $myInfo =
        //     Storage::disk('data')->get('my-info.json');
        // $myInfo = json_decode($myInfo);

        return view('home.home', compact('services', 'skills'));
    }
}
