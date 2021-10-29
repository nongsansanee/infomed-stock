<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'item_sum',
        'status' ,
        'profile',
    ];

    protected $casts = [
        'profile' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->slug = Str::uuid()->toString();
        });
    }
    public function unitCount()
    {
        return $this->hasOne(UnitCount::class,'id','unit_count_id');
    }
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function itemTransactions()
    {
        return $this->hasMany(ItemTransaction::class);
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
                                'item_sum'=>$stock_item['item_receive'],
                                'price'=>$stock_item['price'],
                            ]);
        }
    }
}
