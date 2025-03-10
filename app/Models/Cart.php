<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Define the table if it's not the default 'carts'
    protected $table = 'carts';

    // Define the fillable fields
    protected $fillable = ['user_id', 'medicine_id', 'quantity', 'price', 'pharmacy_id', 'status']; // Include status

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function totalPrice()
    {
        return $this->quantity * $this->price;
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
