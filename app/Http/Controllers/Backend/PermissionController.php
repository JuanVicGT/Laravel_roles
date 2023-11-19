<?php

namespace App\Http\Controllers\Backend;

use App\Models\Permission;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Utils\Enums\AlertType;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Auth::user());

        return view('backend.permission.list')->with('alerts', $this->getAlerts());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Auth::user());

        return view('backend.permission.create')->with('alerts', $this->getAlerts());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $this->authorize('create', Auth::user());

        $permission = Permission::create([
            'name' => $request->name
        ]);

        $this->addAlert(AlertType::Success, ':model-insert-success', ['model' => __('permission')]);

        return redirect()->route('edit.permission', $permission->id)->with('alerts', $this->getAlerts());
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $this->authorize('view', Auth::user());

        $permission = Permission::findOrFail($id);

        return view('backend.permission.show', compact('permission'))->with('alerts', $this->getAlerts());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $this->authorize('update', Auth::user());

        $permission = Permission::findOrFail($id);

        return view('backend.permission.edit', compact('permission'))->with('alerts', $this->getAlerts());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request)
    {
        $this->authorize('update', Auth::user());

        $permission = Permission::findOrFail($request->id);

        $permission->update([
            'name' => $request->name
        ]);

        $this->addAlert(AlertType::Success, ':model-update-success', ['model' => __('permission')]);

        return redirect()->route('edit.permission', $request->id)->with('alerts', $this->getAlerts());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('delete', Auth::user());

        return redirect()->route('list.permission')->with('alerts', $this->getAlerts());
    }
}
