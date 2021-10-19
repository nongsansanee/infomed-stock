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
        'stock_id',
        'stock_categories_id',
        'user_id',
        'item_code',
        'item_name',
        'unit_count_id',
        'status' ,
        'profile',
    ];

    protected $casts = [
        'profile' => 'array',
    ];

    public function unitCount()
    {
        return $this->hasOne(UnitCount::class,'id','unit_count_id');
    }

    public static function loadData($fileName){
        
      
        $stock_items = loadCSV($fileName);
       //$stock_items = loadCSV('business_load_utf8');
      //  \Log::info('FILENAME==>'.$fileName);
        //stocks_id,item_code,item_name,unit_count_id,item_receive,date_receive,date_expire,price,catalog_number,lot_number
        foreach($stock_items as $stock_item){
       //     \Log::info($aaa);
           StockItem::create([
                                'stock_id'=>$stock_item['stocks_id'],
                                'user_id'=>1,
                                'item_code'=>$stock_item['item_code'],
                                'item_name'=>$stock_item['item_name'],
                                'unit_count_id'=>$stock_item['unit_count_id'],
                            ]);
        }
    }
}
