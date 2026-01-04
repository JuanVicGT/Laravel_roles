<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class SharedFundMember extends Model
{
    protected $table = 'sfm_shared_fund_members';

    protected $fillable = [
        'shared_fund_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
