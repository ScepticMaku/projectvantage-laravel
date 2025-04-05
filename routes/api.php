<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\TeamMemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {

    // Authentcation
    Route::put('/reset-password/{id}', [AuthenticationController::class, 'resetPassword']);
    Route::post('/logout', [AuthenticationController::class, 'logout']);

    // Profile
    Route::get('/get-profile', [ProfileController::class, 'getProfile']);
    Route::put('/edit-profile', [ProfileController::class, 'editProfile']);
    Route::put('/change-password', [ProfileController::class, 'changePassword']);

    // User
    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

    // Project
    Route::get('/get-projects', [ProjectController::class, 'getProjects']);
    Route::post('/add-project', [ProjectController::class, 'addProject']);
    Route::put('/edit-project/{id}', [ProjectController::class, 'editProject']);
    Route::delete('/delete-project/{id}', [ProjectController::class, 'deleteProject']);

    // Task
    Route::get('/get-tasks', [TaskController::class, 'getTasks']);
    Route::post('/add-task', [TaskController::class, 'addTask']);
    Route::put('/edit-task/{id}', [TaskController::class, 'editTask']);
    Route::delete('/delete-task/{id}', [TaskController::class, 'deleteTask']);
    Route::put('/assign-task/{id}', [TaskController::class, 'assignTask']);
    Route::put('/replace-task/{id}', [TaskController::class, 'replaceTask']);
    Route::put('/remove-task/{id}', [TaskController::class, 'removeTask']);
    Route::put('/complete-task/{id}', [TaskController::class, 'completeTask']);

    // Team
    Route::get('/get-teams', [TeamController::class, 'getTeams']);
    Route::post('/add-team', [TeamController::class, 'addTeam']);
    Route::put('/edit-team/{id}', [TeamController::class, 'editTeam']);
    Route::delete('/delete-team/{id}', [TeamController::class, 'deleteTeam']);
    Route::put('/assign-team/{id}', [TeamController::class, 'assignTeam']);

    // Team member
    Route::get('/get-team-members', [TeamMemberController::class, 'getTeamMembers']);
    Route::post('/add-team-member', [TeamMemberController::class, 'addTeamMember']);
    Route::put('/edit-team-member/{id}', [TeamMemberController::class, 'editTeamMember']);
    Route::delete('/delete-team-member/{id}', [TeamMemberController::class, 'deleteTeamMember']);

    // Role
    Route::get('/get-roles', [RoleController::class, 'getRoles']);
    Route::post('/add-role', [RoleController::class, 'addRole']);
    Route::put('/edit-role/{id}', [RoleController::class, 'editRole']);
    Route::delete('/delete-role/{id}', [RoleController::class, 'deleteRole']);
});
