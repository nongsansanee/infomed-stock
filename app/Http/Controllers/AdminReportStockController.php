<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaction;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Stock;
use App\Models\StockItem;
use Illuminate\Support\Facades\Log;

// use App\Models\StockItem;
// use App\Models\Unit;
// use Carbon\Carbon;

class AdminReportStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
       // $stock_items = StockItem::where('stock_id','1')->get();
        // $unit = Unit::where('unitid',$division_id)->first();
        $report_lists = [
                ['id'=>'1','updated_at'=>'2021-10-05','unit_name'=>'สาขาวิชาการบริบาลผู้ป่วยนอก','status'=>'ตรวจสอบแล้ว'],
                ['id'=>'2','updated_at'=>'2021-10-06','unit_name'=>'สาขาวิชาความดันโลหิตสูง','status'=>'ตรวจสอบแล้ว'],
                ['id'=>'3','updated_at'=>'2021-10-07','unit_name'=>'สาขาวิชาต่อมไร้ท่อ','status'=>'รอตรวจสอบ'],
        ];
        return Inertia::render('Admin/ListReportStock',[
                        'stocks'=>$stocks,
                        //'stock_items'=>$stock_items,
                        // 'unit'=> $unit,
                        'report_lists'=>$report_lists
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
    public function show($stock_slug,$year,$month)
    {
        Log::info($stock_slug);
        Log::info($year);
        Log::info($month);
      //  return "test";
        $stocks = Stock::where('slug',$stock_slug)->first();
       // Log::info($stocks);
       // $stock_items = StockItem::whereId($stocks->id)->get();
        $stock_item_checkouts = ItemTransaction::with('User:id,name')
                                                ->with('stockItem:id,item_sum')
                                                ->join('stock_items','stock_items.id','=','item_transactions.stock_item_id')
                                                ->where('stock_items.stock_id','=',$stocks->id)
                                                ->where(['year'=>$year,'month'=>$month,'action'=>'checkout'])
                                                ->orderBy('stock_item_id')
                                                ->get();

        Log::info($stock_item_checkouts);
        return response()->json(["item_tran" => $stock_item_checkouts]);
      //  return  $stocks;


       // $stock_items = StockItem::where('stock_id','1')->get();
        // $unit = Unit::where('unitid',$division_id)->first();
        // $report_lists = [
        //         ['id'=>'1','updated_at'=>'2021-10-05','unit_name'=>'สาขาวิชาการบริบาลผู้ป่วยนอก','status'=>'ตรวจสอบแล้ว'],
        //         ['id'=>'2','updated_at'=>'2021-10-06','unit_name'=>'สาขาวิชาความดันโลหิตสูง','status'=>'ตรวจสอบแล้ว'],
        //         ['id'=>'3','updated_at'=>'2021-10-07','unit_name'=>'สาขาวิชาต่อมไร้ท่อ','status'=>'รอตรวจสอบ'],
        // ];
        // return Inertia::render('Admin/ListReportStock',[
        //                 'stocks'=>$stocks,
        //                 //'stock_items'=>$stock_items,
        //                 // 'unit'=> $unit,
        //                 'report_lists'=>$report_lists
        //                 ]);
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
