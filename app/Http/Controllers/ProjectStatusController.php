<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectStatus;

class ProjectStatusController extends Controller
{
    public function getProjectStatuses() {
        $projectStatuses = ProjectStatus::get();

        return response()->json(['project_statuses' => $ProjectStatuses]);
    }

    public function addProjectStatus(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $projectStatus = ProjectStatus::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Status added successfully!', 'project_status' => $ProjectStatus]);
    }

    public function editProjectStatus(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $ProjectStatus = ProjectStatus::find($id);

        if(!$ProjectStatus) {
            return response()->json(['message' => 'Status not found.'], 404);
        }

        $role->update([
            'name' => $request->name,
        ]);

        return reponse()->json(['message' => 'Status successfully updated!', 'project_status' => $ProjectStatus]);
    }

    public function deleteProjectStatus($id) {
        $projectStatus = ProjectStatus::find($id);

        if(!$projectStatus) {
            return response()->json(['message' => 'Status not found.'], 404);
        }

        $projectStatus->delete();

        return response()->json(['message' => 'Status successfully deleted!']);
    }
}
