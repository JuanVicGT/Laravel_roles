<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'sfm_credit_cards';

    protected $fillable = [
        'name',
        'bank',
        'currency',
        'credit_limit',
        'billing_day',
        'payment_due_day',
        'annual_rate_pct',
        'monthly_rate_pct',
        'active',
    ];
}
