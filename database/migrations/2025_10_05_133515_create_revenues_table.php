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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->enum('transaction_type', [
                'certificate_fee',
                'permit_fee',
                'business_tax',
                'penalty',
                'donation',
                'other'
            ]);
            $table->text('description');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['cash', 'check', 'online', 'bank_transfer'])->default('cash');
            $table->string('reference_number')->nullable();
            $table->string('payer_name');
            $table->string('payer_contact')->nullable();
            $table->date('transaction_date');
            $table->string('category')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->text('remarks')->nullable();
            $table->foreignId('received_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
