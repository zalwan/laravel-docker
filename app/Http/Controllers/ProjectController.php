<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        // $projects = Project::latest()->get();

        // return view('pages.projects', [
        //     'projects' => $projects,
        // ]);

        // $projects = Project::all();
        $projects = Project::paginate(2);
        return view("pages.projects", compact("projects"));
    }

    public function show($id): View
    {
        $project = Project::findOrFail($id);
        return view('pages.projects-detail', compact('project'));
    }
}
