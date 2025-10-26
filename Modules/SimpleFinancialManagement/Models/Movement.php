<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'fm_movements';

    protected $fillable = [
        'date',
        'description',
        'income',
        'expense',
        'type',
        'addressee_name',
        'wallet_id',
        'addressee_id',
    ];
}

