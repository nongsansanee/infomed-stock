<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\StockItem;
use App\Models\Stock;

class StockItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($item_id)
    {
       
        $stock_item = StockItem::where('id',$item_id)->first();
        $stock = Stock::where('id',$stock_item->stock_id)->first();
        //get data order list (mock up test UI)
        // $item_check_outs = [
        //     ['id'=>'1','stock_item_id'=>1,'year'=>2021,'month'=>10,'date_check_out'=>'2021-10-25','unit'=>1,'user_id'=>1,'status'=>''],
        //     ['id'=>'2','stock_item_id'=>1,'year'=>2021,'month'=>10,'date_check_out'=>'2021-10-24','unit'=>1,'user_id'=>1,'status'=>'canceled'],
        //     ['id'=>'3','stock_item_id'=>1,'year'=>2021,'month'=>10,'date_check_out'=>'2021-10-23','unit'=>1,'user_id'=>1,'status'=>''],
        //     ['id'=>'4','stock_item_id'=>1,'year'=>2021,'month'=>10,'date_check_out'=>'2021-10-22','unit'=>1,'user_id'=>1,'status'=>''],
        // ];
      
        // \Log::info($stock_item);
        // \Log::info('------------------------');
        // \Log::info($stock_items);
        return Inertia::render('Stock/ItemDetail',[
                                'stock_item'=>$stock_item,
                                'stock' => $stock,
                                // 'item_check_outs' => $item_check_outs,
                                ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
