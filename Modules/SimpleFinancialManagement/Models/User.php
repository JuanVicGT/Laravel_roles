<?php

namespace Modules\SimpleFinancialManagement\Models;

use Modules\Core\Models\User as CoreModel;

use Modules\SimpleFinancialManagement\Models\Wallet;
use Modules\SimpleFinancialManagement\Models\Bucket;
use Modules\SimpleFinancialManagement\Models\CreditCard;
use Modules\SimpleFinancialManagement\Models\Transaction;
use Modules\SimpleFinancialManagement\Models\Tag;

class User extends CoreModel
{
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function buckets()
    {
        return $this->hasMany(Bucket::class);
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
