<?php

namespace Modules\Core\Http\Controllers\Wizard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Utils\Enums\AlertTypeEnum;
use Illuminate\Http\Request;

class WizardController extends Controller
{
    public function index()
    {
        return view('module::Wizard.WizardIndex');
    }

    public function resetPermissions(Request $request)
    {
        $pages = $request["pages"];
        $permissions = $request["permissions"];

        $this->createPagePermissions($pages);
        $this->createCustomPermissions($permissions);

        $this->addAlert('Permissions created successfully', [], AlertTypeEnum::SUCCESS);
        return redirect()->route('wizard.index')->with('alerts', $this->getAlertsArray());
    }

    /**
     * @param array $permissions
     */
    private function createCustomPermissions($permissions = [])
    {
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->first()) {
                Permission::create(['name' => $permission, 'guard_name' => 'web', 'is_custom' => true]);
            }
        }
    }

    /**
     * Create page permissions
     * @param array $pages
     */
    private function createPagePermissions($pages = [])
    {
        foreach ($pages as $page) {
            if (!Permission::where('name', "{$page}.index")->first()) {
                Permission::create(['name' => "{$page}.index", 'guard_name' => 'web']);
            }

            if (!Permission::where('name', "{$page}.store")->first()) {
                Permission::create(['name' => "{$page}.store", 'guard_name' => 'web']);
            }

            if (!Permission::where('name', "{$page}.update")->first()) {
                Permission::create(['name' => "{$page}.update", 'guard_name' => 'web']);
            }

            if (!Permission::where('name', "{$page}.delete")->first()) {
                Permission::create(['name' => "{$page}.delete", 'guard_name' => 'web']);
            }

            if (!Permission::where('name', "{$page}.destroy")->first()) {
                Permission::create(['name' => "{$page}.destroy", 'guard_name' => 'web']);
            }

            if (!Permission::where('name', "{$page}.import")->first()) {
                Permission::create(['name' => "{$page}.import", 'guard_name' => 'web']);
            }

            if (!Permission::where('name', "{$page}.export")->first()) {
                Permission::create(['name' => "{$page}.export", 'guard_name' => 'web']);
            }
        }
    }
}
