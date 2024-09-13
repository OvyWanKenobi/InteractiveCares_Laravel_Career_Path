<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {


        // $services = Storage::disk('data')->json('home-services.json');
        $projects = Storage::disk('data')->get('projects.json');
        $projects = json_decode($projects);
        // dd($projects);

        $categorizedProjects = [];

        foreach ($projects as $project) {
            $category = $project->category ?? 'Uncategorized';
            if (!isset($categorizedProjects[$category])) {
                $categorizedProjects[$category] = [];
            }
            $categorizedProjects[$category][] = $project;
        }

        // dd($categorizedProjects);



        return view('projects.projects', compact('categorizedProjects'));
    }


    public function details($projectName)
    {
        $projects = Storage::disk('data')->get('projects.json');
        $projects = json_decode($projects);

        $projectDetail = "";

        foreach ($projects as $project) {
            if ($project->title == $projectName) {
                $projectDetail = $project;
                break;
            }
        }



        $images = Storage::disk('projectImages')->files($projectDetail->images);

        // dd($projectDetail);
        // dd($images);

        return view('projects.projectDetail', compact('projectDetail', 'images'));
    }
}
