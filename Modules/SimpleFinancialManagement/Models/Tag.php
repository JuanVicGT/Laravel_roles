<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'sfm_tags';

    protected $fillable = [
        'name',
    ];
}
