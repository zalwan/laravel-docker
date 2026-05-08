<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::latest()->paginate(2);

        return view('pages.projects', compact('projects'));
    }

    public function show(int $id): View
    {
        $project = Project::findOrFail($id);

        return view('pages.projects-detail', compact('project'));
    }
}
