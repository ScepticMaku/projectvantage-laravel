<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
use App\Models\Project;

class ProjectController extends Controller
{
    public function getProjects() {
        $projects = Project::with('user', 'projectStatus')->get();

        return response()->json(['projects' => $projects]);
    }

    public function addProject(Request $request) {
        $id = Auth::id();

        $request->validate([
            'project_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'date_created' => ['date'],
            'due_date' => ['required', 'date'],
            'user_id' => ['exists:users,id'],
            'status_id' => ['required', 'exists:project_statuses,id'],
        ]);

        $project = Project::create([
            'project_name' => $request->project_name,
            'description' => $request->description,
            'date_created' => now()->toDateString(),
            'due_date' => $request->due_date,
            'user_id' => $id,
            'status_id' => $request->status_id,
        ]);

        return response()->json(['message' => 'Project successfully added!', 'project' => $project]);
    }

    public function editProject(Request $request, $id) {
        $request->validate([
            'project_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'due_date' => ['nullable','date'],
            'status_id' => ['exists:project_statuses,id'],
        ]);

        $project = Project::find($id);

        if(!$project) {
            return response()->json(['message' => 'Project not found.'], 404);
        }

        $project->update([
            'project_name' => $request->project_name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status_id' => $request->status_id,
        ]);

        return response()->json(['message' => 'Project successfully updated!', 'project' => $project]);
    }

    public function deleteProject($id) {
        $project = Project::find($id);

        if(!$project) {
            return response()->json(['message' => 'Project not found.'], 404);
        }

        $project->delete();

        return response()->json(['message' => 'Project successfully deleted!']);
    }
}
