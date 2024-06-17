<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'product_id');
    }
}
