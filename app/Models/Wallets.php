<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'wallet_id');
    }

    use HasUuids;
}
