<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'total', 'status'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

