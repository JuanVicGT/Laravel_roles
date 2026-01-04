<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'sfm_subcategories';

    protected $fillable = [
        'name',
        'description',
        'bucket_id',
    ];

    public function bucket()
    {
        return $this->belongsTo(Bucket::class);
    }
}
