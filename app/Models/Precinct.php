<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precinct extends Model
{
    use HasFactory;

    protected $fillable = [
        'precinct_number',
        'location',
        'description',
        'total_voters',
        'active_voters',
        'status',
        'created_by'
    ];

    protected $casts = [
        'total_voters' => 'integer',
        'active_voters' => 'integer'
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
