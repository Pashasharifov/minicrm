<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        PermissionHelper::authorizeOrAbort('clients_view');
        $clients = Client::paginate(10);
        return view("clients.index", compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        PermissionHelper::authorizeOrAbort('clients_create');
        PermissionHelper::authorizeOrAbort('clients_view');
        return view("clients.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        Client::create($request->validated());
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): View
    {
        PermissionHelper::authorizeOrAbort('clients_edit');
        PermissionHelper::authorizeOrAbort('clients_view');
        $client = Client::findOrFail($client->id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        PermissionHelper::authorizeOrAbort('clients_delete');
        PermissionHelper::authorizeOrAbort('clients_view');
        $client->delete();
        return redirect()->route('clients.index');
    }
}
