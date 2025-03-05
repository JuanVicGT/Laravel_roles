<?php

namespace Modules\Core\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller; // Importa la clase base
use Illuminate\Http\Request;

class UserManagmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $this->checkPermission('user', 'index');

        return view('module::UserManagment.UserManagmentIndex');
    }
}
