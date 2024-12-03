<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'total_cost', 'status'];

    public function order()
{
    return $this->belongsTo(Order::class);
}
}
