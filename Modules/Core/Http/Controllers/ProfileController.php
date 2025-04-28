<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    #region Vistas
    public function index()
    {
        $this->checkPermission('user', 'index');
    }

    public function create()
    {
        $this->checkPermission('user', 'create');

        return view('module::User.UserCreate');
    }

    public function view($id) {}

    public function edit($id) {}
    #endregion

    #region Acciones
    public function store(Request $request) {}

    public function update() {}

    public function delete() {}

    public function import(Request $request)
    {
        $this->checkPermission('user', 'create');

        // Validar que el archivo es un CSV
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csvFile');
        User::importFromCSV($file);
    }
    #endregion
}
