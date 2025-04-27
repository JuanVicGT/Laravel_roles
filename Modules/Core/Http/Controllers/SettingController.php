<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    #region Vistas
    public function index()
    {
        $this->checkPermission('setting', 'index');

        return view('module::SettingIndex');
    }

    public function view($id) {}

    public function edit($id) {}
    #endregion

    #region Acciones
    public function store(Request $request) {}

    public function update() {}

    public function delete() {}
    #endregion
}
