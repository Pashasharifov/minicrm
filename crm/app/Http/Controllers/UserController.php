<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\ProjectStatus;
use CreateUsersTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View{
        $users = User::paginate(10);
        return view("users.index", compact("users"));
    }
    public function create(): View{
        return view("users.create");
    }
    public function store(StoreUserRequest $request): RedirectResponse{
        User::create($request->validated());
        return redirect()->route('users.index');
    }
    public function edit(User $user): View{
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
        $user->delete();
        return back()->with('success', 'User deleted!');
    }

}
