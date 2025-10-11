<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'national_id',
        'age',
        'birthday',
        'civil_status',
        'gender',
        'purok',
        'precinct_id',
        'religion',
        'occupation',
        'four_ps_beneficiary',
        'pwd_status',
        'voter_status',
        'contact_number',
        'created_by',
    ];

    protected $casts = [
        'birthday' => 'date',
        'four_ps_beneficiary' => 'boolean',
        'pwd_status' => 'boolean',
        'voter_status' => 'boolean',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function precinct()
    {
        return $this->belongsTo(Precinct::class);
    }

    // Scopes for filtering
    public function scopeMale($query)
    {
        return $query->where('gender', 'Male');
    }

    public function scopeFemale($query)
    {
        return $query->where('gender', 'Female');
    }

    public function scopeVoters($query)
    {
        return $query->where('voter_status', true);
    }

    public function scopeNonVoters($query)
    {
        return $query->where('voter_status', false);
    }

    public function scopeByPurok($query, $purok)
    {
        return $query->where('purok', $purok);
    }
}