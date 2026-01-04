<?php

namespace Modules\SimpleFinancialManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BucketController extends Controller
{
    #region Vistas
    public function index()
    {
        $this->checkPermission('bucket', 'index');

        $movements = [];

        return view('module::Movement.MovementIndex', compact('movements'));
    }

    public function view($id) {}

    public function edit($id) {}
    #endregion

    #region Acciones
    public function store(Request $request) {}

    public function update() {}

    public function delete() {}
    #endregion

    #region Funciones
    #endregion
}
