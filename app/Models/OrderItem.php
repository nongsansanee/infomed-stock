<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
   
    protected $table = 'order_items';

    protected $fillable = [ 
        'id',
        'order_no',
        'unit_id',
        'stock_item_id',
        'price',
        'catalog_number',
        'lot_number',
        'user_id' ,
        'stock_categorie_id',
        'year',
        'month',
        'date_order',
        'unit',
        'status',
        'profile',
    ];

    protected $casts = [
        'profile' => 'array',
    ];
}
