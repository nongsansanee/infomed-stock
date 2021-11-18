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
        'create_no',
        'order_no',
        'unit_id',
        'user_id' ,
        'year',
        'month',
        'date_order',
        'status',
        'items',
        'timeline',
    ];

    protected $casts = [
        'items' => 'array',
        'timeline'=>'array'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
