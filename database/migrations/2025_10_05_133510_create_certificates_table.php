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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->enum('certificate_type', [
                'barangay_clearance',
                'certificate_of_residency',
                'certificate_of_indigency',
                'business_permit',
                'building_permit',
                'other'
            ]);
            $table->string('requester_name');
            $table->string('requester_contact');
            $table->text('requester_address');
            $table->text('purpose');
            $table->enum('status', ['pending', 'approved', 'issued', 'rejected'])->default('pending');
            $table->date('issued_date')->nullable();
            $table->string('reference_number')->unique()->nullable();
            $table->decimal('fee_amount', 8, 2)->default(0);
            $table->enum('payment_status', ['unpaid', 'paid', 'waived'])->default('unpaid');
            $table->text('remarks')->nullable();
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('issued_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
