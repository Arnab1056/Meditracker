<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'detail',
        'selled',
        'quantity',
        'maker_name',
        'maker_id',

    ];

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class)->withPivot('quantity');
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}