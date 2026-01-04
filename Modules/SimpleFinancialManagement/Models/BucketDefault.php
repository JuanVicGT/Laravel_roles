<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class BucketDefault extends Model
{
    protected $table = 'sfm_bucket_defaults';

    protected $fillable = [
        'bucket_id',
        'effective_from',
        'amount',
        'note',
    ];
}
