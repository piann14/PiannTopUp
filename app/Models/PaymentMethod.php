<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'category', 'logo',
        'fee_flat', 'fee_percent', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'fee_flat' => 'decimal:2',
        'fee_percent' => 'decimal:2',
    ];

    public function calculateFee($amount)
    {
        return $this->fee_flat + ($amount * ($this->fee_percent / 100));
    }
}
