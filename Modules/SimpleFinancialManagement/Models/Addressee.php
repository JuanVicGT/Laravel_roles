<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Addressee extends Model
{
    protected $table = 'fm_addressees';
    protected $fillable = ['nombre'];
}
