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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->string('generic_name')->nullable();
            $table->string('category');
            $table->string('unit'); // e.g., 'tablet', 'bottle', 'box'
            $table->integer('quantity_in_stock')->default(0);
            $table->integer('reorder_level')->default(10);
            $table->decimal('cost_per_unit', 10, 2);
            $table->date('expiry_date');
            $table->string('supplier')->nullable();
            $table->string('batch_number')->nullable();
            $table->date('received_date');
            $table->enum('status', ['available', 'out_of_stock', 'expired', 'recalled'])->default('available');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
