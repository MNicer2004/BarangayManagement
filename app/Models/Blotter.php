<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    use HasFactory;

    protected $fillable = [
        'complainant_name',
        'complainant_contact',
        'complainant_address',
        'respondent_name',
        'respondent_contact',
        'respondent_address',
        'victims',
        'crime_type',
        'incident_date',
        'incident_time',
        'incident_location',
        'incident_description',
        'case_status',
        'date_reported',
        'action_taken',
        'created_by',
    ];

    protected $casts = [
        'incident_date' => 'date',
        'date_reported' => 'date',
        'incident_time' => 'datetime:H:i',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('case_status', $status);
    }

    public function scopeByCrimeType($query, $type)
    {
        return $query->where('crime_type', $type);
    }
}
