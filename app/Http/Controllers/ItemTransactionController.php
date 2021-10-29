<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\ItemTransaction;
use App\Models\StockItem;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ItemTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info($request->all());
        
        //return "store";
        $stock_item = StockItem::whereSlug($request->item_slug)->first();
        Log::info($stock_item);
        Log::info($stock_item->stock);
        $year_checkout= substr($request->date,0,4);
        $month_checkout= substr($request->date,5,2);
        try{
                ItemTransaction::create(['stock_item_id'=>$stock_item->id ,
                                        'user_id'=>1,
                                        'year'=>$year_checkout,
                                        'month'=>$month_checkout,
                                        'date_action'=>$request->date,
                                        'action'=>'checkout',
                                        'item_count'=>$request->unit,
                                    ]);

        }catch(\Illuminate\Database\QueryException $e){
            //rollback
            return redirect()->back();
        }

        $balance = $stock_item->item_sum - $request->unit;
        Log::info($balance);
        try{
            StockItem::whereSlug($request->item_slug)->update(['item_sum'=>$balance]);
        }catch(\Illuminate\Database\QueryException $e){
             //rollback
            return redirect()->back();
        }
      
     
        return redirect()->back();
       // return Inertia::location($url);
        //return Redirect::route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StockItem $stock_item)
    {
        Log::info('---------show transaction------------');
        Log::info($stock_item);
        Log::info($stock_item->itemTransactions);
        //return "list checkout";
       // $stock_item = StockItem::where('id',$stock_item->id)->first();
        $stock = Stock::where('id',$stock_item->stock_id)->first();
        $item_check_outs = [
            ['id'=>'1','stock_item_id'=>1,'year'=>2021,'month'=>10,'date_check_out'=>'2021-10-25','unit'=>1,'user_id'=>1,'status'=>''],
            ['id'=>'2','stock_item_id'=>1,'year'=>2021,'month'=>10,'date_check_out'=>'2021-10-24','unit'=>1,'user_id'=>1,'status'=>'canceled'],
            ['id'=>'3','stock_item_id'=>1,'year'=>2021,'month'=>10,'date_check_out'=>'2021-10-23','unit'=>1,'user_id'=>1,'status'=>''],
            ['id'=>'4','stock_item_id'=>1,'year'=>2021,'month'=>10,'date_check_out'=>'2021-10-22','unit'=>1,'user_id'=>1,'status'=>''],
        ];
      
        // \Log::info($stock_item);
        // \Log::info('------------------------');
        // \Log::info($stock_items);
       
        return Inertia::render('Stock/ItemDetail',[
                                'stock_item'=>$stock_item,
                                'stock' => $stock,
                                'item_check_outs' => $stock_item->itemTransactions,
                                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
