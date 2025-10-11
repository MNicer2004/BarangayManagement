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
        Schema::create('blotters', function (Blueprint $table) {
            $table->id();
            $table->string('complainant_name');
            $table->string('complainant_contact')->nullable();
            $table->text('complainant_address')->nullable();
            $table->string('respondent_name');
            $table->string('respondent_contact')->nullable();
            $table->text('respondent_address')->nullable();
            $table->string('victims');
            $table->enum('crime_type', [
                'Theft', 'Assault', 'Harassment', 'Vandalism', 'Property Dispute',
                'Noise Complaint', 'Public Disturbance', 'Verbal Threat', 'Trespassing',
                'Shoplifting', 'Fraud', 'Domestic Violence', 'Others'
            ]);
            $table->date('incident_date');
            $table->time('incident_time')->nullable();
            $table->string('incident_location');
            $table->text('incident_description');
            $table->enum('case_status', ['Active', 'Settled', 'Scheduled']);
            $table->date('date_reported');
            $table->text('action_taken')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotters');
    }
};
