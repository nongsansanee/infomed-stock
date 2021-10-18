<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Unit;

class ReportStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($division_id)
    {
        if($division_id == 27){  //หน่วยพัสดุ
            $stocks = Stock::all();
            $stock_items = StockItem::where('stock_id','1')->get();
            $unit = Unit::where('unitid',$division_id)->first();
            return Inertia::render('Stock/CreateReportStock',[
                            'stocks'=>$stocks,
                            'stock_items'=>$stock_items,
                            'unit'=> $unit,
                            ]);
        }else{
            $stocks = Stock::where('unit_id',$division_id)->get();
            $stock_items = StockItem::where('stock_id',$division_id)->get();
            $unit = Unit::where('unitid',$division_id)->first();
            // \Log::info($stocks);
            // \Log::info('------------------------');
            // \Log::info($stock_items);
            return Inertia::render('Stock/CreateReportStock',[
                                    'stocks'=>$stocks,
                                    'stock_items'=>$stock_items,
                                    'unit'=> $unit,
                                    ]);
        }
       
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
    public function show($division_id)
    {
        $stocks = Stock::where('unit_id',$division_id)->get();
        // $stock_items = StockItem::where('stock_id',$division_id)->get();
        $unit = Unit::where('unitid',$division_id)->first();

        //get data order list (mock up test UI)
        $report_stock_lists = [
                        ['id'=>'1','year'=>2021,'month'=>9,'status'=>'สร้างรายงาน'],
                        ['id'=>'2','year'=>2021,'month'=>8,'status'=>'รอหน่วยพัสดุตรวจสอบ'],
                        ['id'=>'3','year'=>2021,'month'=>7,'status'=>'ตรวจสอบแล้ว'],
                        ['id'=>'4','year'=>2021,'month'=>6,'status'=>'ตรวจสอบแล้ว'],
        ];
        // \Log::info($stocks);
        // \Log::info('------------------------');
        // \Log::info($stock_items);
        return Inertia::render('Stock/ReportStockList',[
                                    'stocks'=>$stocks,
                                    'unit'=> $unit,
                                    'report_stock_lists' =>$report_stock_lists,
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
