<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'medicine_id',
        'medicine_name',
        'quantity',
        'price',
        'sold',
        'status',
    ];

    protected $attributes = [
        'status' => 'pending', // Ensure default value is set to pending
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
