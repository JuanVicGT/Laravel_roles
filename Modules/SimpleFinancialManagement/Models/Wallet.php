<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'fm_wallets';

    protected $fillable = [
        'name',
        'reason',
        'amount',
    ];
}

