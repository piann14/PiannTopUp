<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('game_user_id'); // ID akun game
            $table->string('game_server')->nullable(); // Server game
            $table->string('game_username')->nullable(); // Username game
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone')->nullable();
            $table->decimal('amount', 12, 2);
            $table->decimal('admin_fee', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2);
            $table->string('payment_method');
            $table->string('payment_channel')->nullable();
            $table->string('status')->default('pending'); // pending, paid, processing, completed, failed, cancelled
            $table->string('payment_token')->nullable();
            $table->string('payment_url')->nullable();
            $table->json('payment_data')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
