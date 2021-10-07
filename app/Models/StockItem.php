<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;

    protected $table = 'stock_items';

    protected $fillable = [ 
        'id',
        'stocks_id',
        'stock_categories_id',
        'user_id',
        'item_code',
        'item_name',
        'unit_counts_id',
        'item_receive',
        'date_receive',
        'date_expire',
        'price',
        'catalog_number',
        'lot_number',
        'status' 
    ];

    public static function loadData($fileName){
      
        $stock_items = loadCSV($fileName);
       
        foreach($stock_items as $stock_item){
           // \Log::info($business);
           StockItem::create([
                                'stocks_id'=>$stock_item['business_doc_id'],
                                'user_id'=>1,
                            ]);
        }
    }
}
