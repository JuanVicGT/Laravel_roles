<?php

namespace Modules\Core\Models;

use App\Models\User as BaseUser;
use App\Utils\ImportData;
use Illuminate\Support\Facades\DB;

class User extends BaseUser
{
    public function assignRole(...$roles)
    {
        return $this->roles()->sync($roles);
    }

    public function removeRole(...$roles)
    {
        return $this->roles()->detach($roles);
    }

    public function cleanRoles()
    {
        return $this->roles()->detach();
    }

    public static function importFromCSV(&$file)
    {
        $usersToInsert = [];
        $errors = [];

        /**
         * Indicamos la columna con la que se encuentra en el csv y el nombre de la columna
         * con la que se va a insertar, además del index de la columna en el csv
         */
        $filleableColumns = [
            __('Name') => ['column' => 'name', 'key' => null],
            __('Is Active') => ['column' => 'is_active', 'key' => null, 'default' => true, 'type' => 'boolean'],
            __('Is Admin') => ['column' => 'is_admin', 'key' => null],
            __('Type Layout') => ['column' => 'type_layout', 'key' => null],

            // Columnas que deben ser únicas y solo se generan aleatoriamente para pruebas
            __('Email') => ['column' => 'email', 'key' => null, 'type' => 'random_email', 'default' => 'email'],
            __('Password') => ['column' => 'password', 'key' => null, 'type' => 'password', 'default' => 'password'],
            __('Username') => ['column' => 'username', 'key' => null, 'type' => 'random_username', 'default' => 'username']
        ];

        $usersToInsert = ImportData::getImportDataFromCSV($file, $filleableColumns);

        DB::beginTransaction();

        try {
            $insertedUsers = self::insert($usersToInsert);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $errores = $e->getMessage();
        }

        if ($insertedUsers !== true) {
            DB::rollBack();
        }

        /*         DB::beginTransaction();
        $insertedUsers = User::insert($usersToinsert);

        if ($insertedUsers) {
            DB::commit();
        } else {
            DB::rollBack();
        } */

        dd($insertedUsers, $errors);
    }

    /* 
        $users = ImportData::getImportDataFromCSV($file, $filleableColumns);

        $usersToInsert = [];
        $errores = [];

        foreach ($users as $user) {
            $user['password'] = bcrypt($user['password']);
            $usersToInsert[] = $user;
        }

        DB::beginTransaction();

        try {
            $insertados = self::insert($usersToInsert);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $errores = $e->getMessage();
        }

        if ($errores) {
            // Mostrar notificación de errores
            // Puedes utilizar la variable $errores para mostrar los detalles del error
        } else {
            // Mostrar notificación de éxito
        }
        */

    /* 
    
        $users = ImportData::getImportDataFromCSV($file, $filleableColumns);

        $usersToInsert = [];
        $errores = [];

        foreach ($users as $user) {
            $user['password'] = bcrypt($user['password']);
            $usersToInsert[] = $user;
        }

        $insertados = self::insertOrIgnore($usersToInsert);

        $errores = array_diff(array_keys($usersToInsert), $insertados);

        if ($errores) {
            // Mostrar notificación de errores
            // Puedes utilizar la variable $errores para mostrar los detalles del error
        } else {
            // Mostrar notificación de éxito
        }

    */
}
