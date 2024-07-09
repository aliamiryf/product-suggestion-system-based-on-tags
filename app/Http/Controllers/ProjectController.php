<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getAllProjects()
    {
        $projects = Project::with(['categories', 'thumbnail'])->orderByRaw("ISNULL(`order`), `order` ASC")->get();
        return response()->json(['data' => $projects]);
    }

    public function getProjectBaseOnSlug($slug)
    {
        $project = Project::where('slug', $slug)->with(['categories', 'files', 'thumbnail']);
        if (!$project->exists()) {
            return abort(404);
        }
        return response()->json(['data' => $project->first()]);
    }
}
