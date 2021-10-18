<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Unit;
use Carbon\Carbon;

class CreateOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($division_id)
    {
        $stocks = Stock::where('unit_id',$division_id)->get();
        $stock_items = StockItem::where('stock_id',$division_id)->get();
        $unit = Unit::where('unitid',$division_id)->first();

    
        // \Log::info($stocks);
        // \Log::info('------------------------');
        // \Log::info($stock_items);

        $mutable = Carbon::now();
        //\Log::info($mutable);
        $tmp_date_now = explode(' ', $mutable);
        $split_date_now = explode('-', $tmp_date_now[0]);
        $year = (int) $split_date_now[0] + 543;
        $thaimonth = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        $date_now_show = $split_date_now[2].'  '.$thaimonth[(int) $split_date_now[1]].' '.$year;

        return Inertia::render('Stock/CreateOrder',[
                                'stocks'=>$stocks,
                                'stock_items'=>$stock_items,
                                'unit'=> $unit,
                                'sysdate'=>$tmp_date_now[0],
                                'sysdate_thai'=>$date_now_show,
                                
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
    public function show($division_id)
    {
        $stocks = Stock::where('unit_id',$division_id)->get();
        // $stock_items = StockItem::where('stock_id',$division_id)->get();
        $unit = Unit::where('unitid',$division_id)->first();

        //get data order list (mock up test UI)
        $order_lists = [
                        ['id'=>'1','year'=>2021,'month'=>9,'status'=>'สร้างใบสั่งซื้อ'],
                        ['id'=>'2','year'=>2021,'month'=>8,'status'=>'รออนุมัติ'],
                        ['id'=>'3','year'=>2021,'month'=>7,'status'=>'ได้รับอนุมัติแล้ว'],
                        ['id'=>'4','year'=>2021,'month'=>6,'status'=>'ตรวจรับพัสดุแล้ว'],
        ];
        // \Log::info($stocks);
        // \Log::info('------------------------');
        // \Log::info($stock_items);

        // $mutable = Carbon::now();
        // //\Log::info($mutable);
        // $tmp_date_now = explode(' ', $mutable);
        // $split_date_now = explode('-', $tmp_date_now[0]);
        // $year = (int) $split_date_now[0] + 543;
        // $thaimonth = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        // $date_now_show = $split_date_now[2].'  '.$thaimonth[(int) $split_date_now[1]].' '.$year;

        return Inertia::render('Stock/OrderList',[
                                                'stocks'=>$stocks,
                                                'unit'=> $unit,
                                                'order_lists' =>$order_lists,
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
