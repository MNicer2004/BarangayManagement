<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
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
        'position',
        'chairmanship',
        'four_ps_beneficiary',
        'pwd_status',
        'voter_status',
        'contact_number',
        'email',
        'status',
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

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeVoters($query)
    {
        return $query->where('voter_status', true);
    }
}
