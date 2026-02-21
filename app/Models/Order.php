<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'product_id', 'game_user_id', 'game_server',
        'game_username', 'buyer_name', 'buyer_email', 'buyer_phone',
        'amount', 'admin_fee', 'total_amount', 'payment_method',
        'payment_channel', 'status', 'payment_token', 'payment_url',
        'payment_data', 'paid_at', 'completed_at', 'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'admin_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'payment_data' => 'array',
        'paid_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function generateOrderNumber()
    {
        $prefix = 'PTU';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -6));
        return $prefix . $date . $random;
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
                'pending' => ['class' => 'badge-warning', 'label' => 'Menunggu Pembayaran'],
                'paid' => ['class' => 'badge-info', 'label' => 'Dibayar'],
                'processing' => ['class' => 'badge-primary', 'label' => 'Diproses'],
                'completed' => ['class' => 'badge-success', 'label' => 'Selesai'],
                'failed' => ['class' => 'badge-danger', 'label' => 'Gagal'],
                'cancelled' => ['class' => 'badge-secondary', 'label' => 'Dibatalkan'],
                default => ['class' => 'badge-secondary', 'label' => 'Unknown'],
            };
    }
}
