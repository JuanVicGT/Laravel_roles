<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionTag extends Model
{
    protected $table = 'sfm_transaction_tags';

    protected $fillable = [
        'transaction_id',
        'tag_id',
    ];
}
