<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string module
 * @property string settings
 * @property string update_at
 * @property string created_at
 */
class AppSetting extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'module',
        'settings'
    ];


}
