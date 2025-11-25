<?php

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
        Schema::table('orders', function (Blueprint $table) {
            // Pilihan: 'pickup' (Ambil Sendiri) atau 'delivery' (Diantar)
            $table->enum('delivery_method', ['pickup', 'delivery'])->default('pickup')->after('status');

            // Biaya ongkir (0 atau 5000)
            $table->decimal('shipping_cost', 10, 2)->default(0)->after('total_amount');

            // Pilihan: 'cash' atau 'qris'
            $table->enum('payment_method', ['cash', 'qris'])->default('cash')->after('shipping_cost');

            // Untuk menyimpan nama file gambar bukti bayar QRIS
            $table->string('payment_proof')->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_method', 'shipping_cost', 'payment_method', 'payment_proof']);
        });
    }
};
