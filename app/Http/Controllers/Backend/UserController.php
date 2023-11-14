<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

        return view('backend.user.list_user')->with('alerts', $this->getAlerts());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Auth::user());

        return view('backend.user.create_user')->with('alerts', $this->getAlerts());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', Auth::user());

        return redirect()->route('edit.item')->with('alerts', $this->getAlerts());
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $this->authorize('view', Auth::user());

        return view('backend.user.show_user')->with('alerts', $this->getAlerts());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $this->authorize('update', Auth::user());

        return view('backend.user.edit_user')->with('alerts', $this->getAlerts());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', Auth::user());

        return redirect()->route('edit.item')->with('alerts', $this->getAlerts());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', Auth::user());

        return redirect()->route('edit.item')->with('alerts', $this->getAlerts());
    }
}
