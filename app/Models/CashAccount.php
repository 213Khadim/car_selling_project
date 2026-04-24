<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'balance', 'currency', 'notes'];

    protected $casts = ['balance' => 'decimal:2'];

    public function transfersFrom()
    {
        return $this->hasMany(CashTransfer::class, 'from_account_id');
    }

    public function transfersTo()
    {
        return $this->hasMany(CashTransfer::class, 'to_account_id');
    }
}
