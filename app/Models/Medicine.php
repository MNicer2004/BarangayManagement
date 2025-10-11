<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'brand',
        'generic_name',
        'category',
        'unit',
        'quantity_in_stock',
        'reorder_level',
        'cost_per_unit',
        'expiry_date',
        'supplier',
        'batch_number',
        'received_date',
        'status',
        'notes',
        'created_by'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'received_date' => 'date',
        'cost_per_unit' => 'decimal:2',
        'quantity_in_stock' => 'integer',
        'reorder_level' => 'integer'
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeInStock($query)
    {
        return $query->where('quantity_in_stock', '>', 0);
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('quantity_in_stock', '<=', 'reorder_level');
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    public function scopeExpiringSoon($query, $days = 30)
    {
        return $query->where('expiry_date', '<=', now()->addDays($days))
                    ->where('expiry_date', '>=', now());
    }
}