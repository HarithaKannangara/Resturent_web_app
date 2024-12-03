<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concession extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_path', 'price'];

    public function order()
    {
        return $this->hasOne(order::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders', 'id', 'id');
    }
}
