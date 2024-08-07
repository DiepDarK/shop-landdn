<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('name_P');
            $table->string('email_P');
            $table->string('phone_P');
            $table->string('address_P');
            $table->text('note')->nullable();
            $table->string('status_order')->default(Order::CHO_XAC_NHAN);
            $table->string('status_pay')->default(Order::CHUA_THANH_TOAN);
            $table->double('payment');
            $table->double('ship');
            $table->double('total_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
