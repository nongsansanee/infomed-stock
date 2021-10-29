<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    use HasFactory;
    protected $table = 'item_transactions';

    protected $fillable = [ 
        'id',
        'stock_item_id',
        'user_id',
        'order_item_id',
        'year',
        'month',
        'date_action',
        'action',
        'date_expire',
        'item_count',
        'status',
        'profile',
    ];

    protected $casts = [
        'profile' => 'array',
    ];

    public function stockItem()
    {
        return $this->hasOne(StockItem::class);
    }
}
