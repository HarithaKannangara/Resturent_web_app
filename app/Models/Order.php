<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'selected_concessions',
        'send_to_kitchen_time',
        'status',
        'quantities',
    ];

    // Accessor for quantities (decode JSON to array)
    public function getQuantitiesAttribute($value)
    {
        return json_decode($value, true);
    }

    // Mutator for quantities (encode array to JSON)
    public function setQuantitiesAttribute($value)
    {
        $this->attributes['quantities'] = json_encode($value);
    }
    // Define a relationship with the Kitchen model
    public function kitchen()
    {
        return $this->hasOne(Kitchen::class);
    }

    public function concession()
    {
        return $this->hasOne(concession::class);
    }
    public function concessions()
    {
        return $this->belongsToMany(Concession::class, 'concessions', 'id', 'id')
                    ->whereIn('id', $this->selected_concessions);
    }

    protected $casts = [
        'selected_concessions' => 'array', // Ensures it's always an array
        'quantities' => 'array',           // Decodes JSON into an associative array
    ];

}
