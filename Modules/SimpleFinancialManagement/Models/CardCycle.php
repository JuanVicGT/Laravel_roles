<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class CardCycle extends Model
{
    protected $table = 'sfm_card_cycles';

    protected $fillable = [
        'credit_card_id',
        'period_start',
        'period_end',
        'statement_amount',
        'statement_date',
        'due_date',
        'paid_amount',
        'paid_date',
        'interest_charged',
    ];
}
