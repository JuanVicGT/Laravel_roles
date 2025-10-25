<?php

namespace Modules\Core\Http\Controllers;

use Modules\Core\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Enums\AlertTypeEnum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    #region Vistas
    public function edit()
    {
        $user = auth()->user();

        return view('module::Profile.ProfileEdit', compact('user'));
    }
    #endregion

    #region Acciones

    public function passwordUpdate(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->addAlert(__('Password updated successfully'), [], AlertTypeEnum::SUCCESS);
        return back()->with('alerts', $this->getAlerts());
    }

    public function store(Request $request) {}

    public function updateLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required|string|max:5'
        ]);

        $user = auth()->user();
        $user->locale = $request->locale;
        $user->save();

        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'locale' => 'required|string|max:5'
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->locale = $request->locale;
        $user->save();

        $this->addAlert(__('Profile updated successfully'), [], AlertTypeEnum::SUCCESS);
        return back()->with('alerts', $this->getAlerts());
    }

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
