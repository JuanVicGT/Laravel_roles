<?php

namespace Modules\SimpleFinancialManagement\Http\Controllers\Movement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Enums\AlertTypeEnum;
use Modules\SimpleFinancialManagement\Models\Movement;

class MovementController extends Controller
{
    #region Vistas
    public function index()
    {
        $this->checkPermission('movement', 'index');

        $movements = Movement::all();

        return view('module::Movement.MovementIndex', compact('movements'));
    }

    public function view($id) {}

    public function edit($id) {}
    #endregion

    #region Acciones
    public function store(Request $request)
    {
    }

    public function update() {}

    public function delete() {}
    #endregion

    #region Funciones
    #endregion
}
