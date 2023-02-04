<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at'
    ];

    protected $guarded = [];

    public function getNameAttribute()
    {
        return json_decode($this->attributes['data'], true)['name'];
    }

    public function getPriceAttribute()
    {
        return json_decode($this->attributes['data'], true)['price'];
    }

    public function getQuantityAttribute()
    {
        return json_decode($this->attributes['data'], true)['quantity_in_stock'];
    }

    public function getCreatedAtAttribute()
    {
        return $this->attributes['created_at'];
    }
}
