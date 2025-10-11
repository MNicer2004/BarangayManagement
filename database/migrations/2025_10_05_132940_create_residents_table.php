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
        Schema::create('residents', function (Blueprint $table) {
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
            $table->boolean('four_ps_beneficiary')->default(false);
            $table->boolean('pwd_status')->default(false);
            $table->boolean('voter_status')->default(false);
            $table->string('contact_number')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
