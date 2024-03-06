<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Utils\Enums\AlertType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Auth::user());

        return view('backend.user.ListUser')->with('alerts', $this->getAlerts());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Auth::user());

        return view('backend.user.CreateUser')->with('alerts', $this->getAlerts());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', Auth::user());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'admin' => $request->is_admin,
            'password' => Hash::make($request->password)
        ]);

        $this->addAlert(AlertType::Success, ':model-insert-success', ['model' => __('user')]);

        return redirect()->route('edit.user', $user->id)->with('alerts', $this->getAlerts());
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $this->authorize('view', Auth::user());

        $user = User::findOrFail($id);

        return view('backend.user.ViewUser', compact('user'))->with('alerts', $this->getAlerts());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $this->authorize('update', Auth::user());

        $user = User::findOrFail($id);

        return view('backend.user.EditUser', compact('user'))->with('alerts', $this->getAlerts());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $this->authorize('update', Auth::user());

        $user = User::findOrFail($request->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'admin' => $request->is_admin,
            'password' => empty($request->password) ? $user->password : Hash::make($request->password)
        ]);

        $this->addAlert(AlertType::Success, ':model-update-success', ['model' => __('user')]);

        return redirect()->route('edit.user', $request->id)->with('alerts', $this->getAlerts());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', Auth::user());

        return redirect()->route('list.user')->with('alerts', $this->getAlerts());
    }
}
