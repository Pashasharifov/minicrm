<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        PermissionHelper::authorizeOrAbort('tasks_view');
        if (Auth::user()->isUser()) {
            $tasks = Task::with(['project.client', 'assignedUser', 'creator'])
                ->where('assigned_to', Auth::id())
                // ->orWhere('created_by', Auth::id())
                ->paginate(10);
            return view('tasks.index', compact('tasks'));   
        }
        $tasks = Task::with(['project.client', 'assignedUser', 'creator'])->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        PermissionHelper::authorizeOrAbort('tasks_create');
        PermissionHelper::authorizeOrAbort('tasks_view');
        $projects = Project::with('client')->get();
        $users = User::all();

        $statuses = [
            Task::STATUS_PENDING,
            Task::STATUS_IN_PROGRESS,
            Task::STATUS_COMPLETED
        ];

        return view('tasks.create', compact('projects', 'users', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request = $request->validated();
        Task::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'project_id' => $request['project_id'],
            'assigned_to' => $request['assigned_to'],
            'created_by' => Auth::id(),
            'status' => $request['status'] ?? Task::STATUS_PENDING,
            'due_date' => $request['due_date'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task uğurla yaradıldı!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load(['project.client', 'assignedUser', 'creator']);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        PermissionHelper::authorizeOrAbort('tasks_edit');
        PermissionHelper::authorizeOrAbort('tasks_view');
        $projects = Project::with('client')->get();
        $users = User::all();

        $statuses = [
            Task::STATUS_PENDING,
            Task::STATUS_IN_PROGRESS,
            Task::STATUS_COMPLETED,
        ];

        return view('tasks.edit', compact('task', 'projects', 'users', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $request = $request->validated();
        $task->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'project_id' => $request['project_id'],
            'assigned_to' => $request['assigned_to'],
            'status' => $request['status'],
            'due_date' => $request['due_date'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task uğurla yeniləndi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        PermissionHelper::authorizeOrAbort('tasks_delete');
        PermissionHelper::authorizeOrAbort('tasks_view');
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task silindi (bərpa oluna bilər).');
    }
    
    /**
     * Silinmiş task-ların siyahısı
     */
    public function trashed()
    {
        $tasks = Task::onlyTrashed()->with(['project.client', 'assignedUser'])->paginate(10);

        return view('tasks.trashed', compact('tasks'));
    }

    /**
     * Silinmiş task-ı bərpa etmək
     */
    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->route('tasks.trashed')->with('success', 'Task bərpa olundu!');
    }

    /**
     * Task-ı tam silmək (DB-dən)
     */
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();

        return redirect()->route('tasks.trashed')->with('success', 'Task tamamilə silindi!');
    }
}
