<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $category = Category::withCount('projects')->with('thumbnail')->get();
        return response()->json(['data' => $category]);
    }

    public function getProjectsFromCategory($slug)
    {
        $category = Category::where('slug', $slug)->with(['projects','thumbnail','projects.categories','projects.thumbnail']);
        if (!$category->exists()) {
            return abort(404);
        }
        return response()->json(['data' => $category->first()]);

    }
}
