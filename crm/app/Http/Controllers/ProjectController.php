<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        PermissionHelper::authorizeOrAbort('projects_view');
        if (Auth::user()->isUser()) {
            $projects = Project
                ::where('user_id', Auth::id())
                // ->orWhere('created_by', Auth::id())
                ->paginate(10);
            return view('projects.index', compact('projects'));   
        }
        $projects = Project::paginate(10);
        return view("projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        PermissionHelper::authorizeOrAbort('projects_create');
        PermissionHelper::authorizeOrAbort('projects_view');
        $users = User::select(['id', 'first_name', 'last_name'])->get();
        $clients = Client::select(['id', 'company_name'])->get();
        return view("projects.create", compact('users', "clients"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        Project::create($request->validated());
        return redirect()->route("projects.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        PermissionHelper::authorizeOrAbort('projects_edit');
        PermissionHelper::authorizeOrAbort('projects_view');
        $users = User::select(['id', 'first_name', 'last_name'])->get();
        $clients = Client::select(['id', 'company_name'])->get();
        return view("projects.edit", compact("project", 'users', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        return redirect()->route("projects.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        PermissionHelper::authorizeOrAbort('projects_delete');
        PermissionHelper::authorizeOrAbort('projects_view');
        $project->delete();
        return redirect()->route("projects.index");
    }
}
