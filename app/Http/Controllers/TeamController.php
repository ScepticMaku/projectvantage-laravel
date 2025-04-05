<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function getTeams() {
        $teams = Team::with('project')->get();

        return response()->json(['teams' => $teams]);
    }

    public function addTeam(Request $request) {
        $request->validate([
            'team_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'project_id' => ['nullable', 'exists:projects,id'],
        ]);

        $team = Team::create([
            'team_name' => $request->team_name,
            'description' => $request->description,
            'project_id' => $request->project_id,
        ]);

        return response()->json(['message' => 'Team added successfully!', 'team' => $team]);
    }

    public function assignTeam(Request $request, $id) {
        $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
        ]);

        $team = Team::find($id);

        if(!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        $team->update([
            'project_id' => $request->project_id,
        ]);

        return response()->json(['message' => 'Team successfully assigned!', 'team' => $team]);
    }

    public function editTeam(Request $request, $id) {
        $request->validate([
            'team_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'project_id' => ['nullable', 'exists:projects,id'],
        ]);

        $team = Team::find($id);

        if(!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        $team->update([
            'team_name' => $request->team_name,
            'description' => $request->description,
            'project_id' => $request->project_id,
        ]);

        return response()->json(['message' => 'Team successfully edited!', 'team' => $team]);
    }

    public function deleteTeam($id) {
        $team = Team::find($id);
        
        if(!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        $team->delete();

        return response()->json(['message' => 'Team successfully deleted!']);
    }
}
