<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Utils\Enums\AlertType;
use App\Http\Utils\PermissionTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Auth::user());

        return view('backend.role.list')->with('alerts', $this->getAlerts());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Auth::user());

        return view('backend.role.create')->with('alerts', $this->getAlerts());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Auth::user());

        $role = Role::create([
            'name' => $request->name
        ]);

        $this->addAlert(AlertType::Success, ':model-insert-success', ['model' => __('role')]);

        return redirect()->route('edit.role', $role->id)->with('alerts', $this->getAlerts());
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $this->authorize('view', Auth::user());

        $role = Role::findOrFail($id);

        return view('backend.role.show', compact('role'))->with('alerts', $this->getAlerts());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $this->authorize('update', Auth::user());

        $role = Role::findOrFail($id);
        $permissionModels = PermissionTools::PERMISSION_MODELS;

        return view('backend.role.edit', compact('role', 'permissionModels'))->with('alerts', $this->getAlerts());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request)
    {
        $this->authorize('update', Auth::user());

        $role = Role::findOrFail($request->id);

        $role->update([
            'name' => $request->name
        ]);

        $this->addAlert(AlertType::Success, ':model-update-success', ['model' => __('role')]);

        return redirect()->route('edit.role', $request->id)->with('alerts', $this->getAlerts());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', Auth::user());

        return redirect()->route('list.role')->with('alerts', $this->getAlerts());
    }

    public function assignPermissions(Request $request)
    {
        $this->authorize('update', Auth::user());

        $permissions = [];

        foreach (PermissionTools::PERMISSION_MODELS as $model) {
            foreach (PermissionTools::PERMISSION_ACTIONS as $action) {
                $permission = "{$action}_{$model}";

                if ($request->$permission)
                    $permissions[] = "{$action}_{$model}";
            }
        }

        $role = Role::findOrFail($request->id);
        $role->syncPermissions($permissions);

        $this->addAlert(AlertType::Success, ':model-update-success', ['model' => __('role')]);

        return redirect()->route('edit.role', $request->id)->with('alerts', $this->getAlerts());
    }
}
