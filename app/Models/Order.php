<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'cake_id'];

    public function cake()
    {
        return $this->belongsTo(Cake::class);
    }

    public function hasCakes() {
        return $this->cake->quantity > 0;
    }
}
