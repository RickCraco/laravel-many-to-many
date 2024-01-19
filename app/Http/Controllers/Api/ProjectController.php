<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all()->load(['category', 'technologies']);
        return response()->json($projects);
    }

    public function show(Project $project)
    {
        //$project = Project::where('id', $project->id)->with(['category', 'technologies'])->get();
        return response()->json($project->load(['category', 'technologies']));
    }
}
