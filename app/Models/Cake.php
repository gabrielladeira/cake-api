<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'weight', 'quantity'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
