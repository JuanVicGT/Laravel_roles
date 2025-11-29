<?php

namespace Modules\SimpleFinancialManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'fm_movements';

    protected $fillable = [
        'date',
        'description',
        'income',
        'expense',
        'type',
        'addressee_name',
        'wallet_id',
        'addressee_id',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function addressee()
    {
        return $this->belongsTo(Addressee::class);
    }

    public static function getTotals()
    {
        $totals = Movement::selectRaw("
            SUM(CASE WHEN type = 'income' THEN income ELSE 0 END) as total_income,
            SUM(CASE WHEN type = 'expense' THEN expense ELSE 0 END) as total_expense
        ")->first();

        return [
            'total_income' => $totals->total_income,
            'total_expense' => $totals->total_expense,
            'total_balance' => $totals->total_income - $totals->total_expense,
        ];
    }
}
