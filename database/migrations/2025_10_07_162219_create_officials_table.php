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
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('national_id')->unique();
            $table->integer('age');
            $table->date('birthday');
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Divorced', 'Separated']);
            $table->enum('gender', ['Male', 'Female']);
            $table->string('purok');
            $table->unsignedBigInteger('precinct_id')->nullable();
            $table->string('religion');
            $table->string('occupation');
            $table->string('position'); // Official position (Captain, Kagawad, etc.)
            $table->string('chairmanship')->nullable(); // Committee chairmanship
            $table->boolean('four_ps_beneficiary')->default(false);
            $table->boolean('pwd_status')->default(false);
            $table->boolean('voter_status')->default(false);
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            // Add foreign key constraint for precinct
            $table->foreign('precinct_id')->references('id')->on('precincts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officials');
    }
};
