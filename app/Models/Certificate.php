<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_type',
        'requester_name',
        'requester_contact',
        'requester_address',
        'purpose',
        'status',
        'issued_date',
        'reference_number',
        'fee_amount',
        'payment_status',
        'remarks',
        'requested_by',
        'approved_by',
        'issued_by'
    ];

    protected $casts = [
        'issued_date' => 'date',
        'fee_amount' => 'decimal:2'
    ];

    // Relationships
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeIssued($query)
    {
        return $query->where('status', 'issued');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }
}
