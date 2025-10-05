<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\ProjectStatus;
use CreateUsersTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View{
        // dd(Auth::user()->toArray());
        PermissionHelper::authorizeOrAbort('users_view');
        $users = User::paginate(10);
        return view("users.index", compact("users"));
    }
    public function create(): View{
        PermissionHelper::authorizeOrAbort('users_create');
        PermissionHelper::authorizeOrAbort('users_view');
        return view("users.create");
    }
    public function store(StoreUserRequest $request): RedirectResponse{
        $data = $request->validated();
        if($request->hasFile('avatar')){
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        User::create($data);
        return redirect()->route('users.index');
    }
    public function edit(User $user): View{
        PermissionHelper::authorizeOrAbort('users_edit');
        PermissionHelper::authorizeOrAbort('users_view');
        $user = User::findOrFail($user->id);
        return view("users.edit", compact("user"));
    }
    public function update(User $user, UpdateUserRequest $request): View{
        $user = User::findOrFail($user->id);
        $user->update($request->validated());
        $users = User::paginate(10);
        return view("users.index", compact("users"));
    }
    public function destroy(User $user){
        PermissionHelper::authorizeOrAbort('users_delete');
        PermissionHelper::authorizeOrAbort('users_view');
        if (!Gate::allows('delete-user', $user))
            abort(403, 'Access denied');
        $user->delete();
        return back()->with('success', 'User deleted!');
    }

}
