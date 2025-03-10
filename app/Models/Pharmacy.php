<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $table = 'pharmacies'; // Ensure the table name is correct

    protected $fillable = [
        'name',
        'location',
        'email',
        'phone',
        'role',
        'user_id',
    ];

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
