<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke orders dengan ON DELETE CASCADE
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->onDelete('cascade');

            // Foreign Key ke products dengan ON DELETE CASCADE
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');

            $table->integer('quantity');
            $table->decimal('price', 12, 2);
            $table->decimal('subtotal', 12, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};