<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class SharedFund extends Model
{
    protected $table = 'sfm_shared_funds';

    protected $guarded = ['id'];
}
