<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $table = 'sfm_buckets';
    
    protected $fillable = [
        'name',
        'description',
        'kind',
    ];
}
