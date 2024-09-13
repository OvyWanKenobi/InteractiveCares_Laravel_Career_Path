<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index()
    {

        // $services = Storage::disk('data')->json('home-services.json');
        $experiences = Storage::disk('data')->get('experiences.json'); //laravel 10
        $experiences = json_decode($experiences);
        // dd($services);


        $educations = Storage::disk('data')->get('educations.json');
        $educations = json_decode($educations);

        return view('work-experience.workExperience', compact('experiences', 'educations'));
    }
}
