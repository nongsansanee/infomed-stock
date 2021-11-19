<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\ItemTransaction;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

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

        foreach($stock_items as $key=>$stock_item){
            $checkin_last = ItemTransaction::where('stock_item_id',$stock_item->id)
                                            ->where('action','checkin')
                                            ->where('status','active')
                                            ->latest()
                                            ->first();
            $stock_items[$key]['checkin_last'] = $checkin_last;
        }

        $businesses = Business::all();

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
                                'businesses'=>$businesses,
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
        //dd($request);
        Log::info($request);
        //Log::info($request->order_items[0]['stock_id']);
        $mutable = Carbon::now();
        //\Log::info($mutable);
        $tmp_date_now = explode(' ', $mutable);
        $split_date_now = explode('-', $tmp_date_now[0]);

        $last_create_no = OrderItem::select('create_no')
                            ->where('unit_id',$request->order_items[0]['stock_id'])
                            ->where('year',$split_date_now[0])
                            ->orderBy('create_no','desc')
                            ->first();
        if($last_create_no == null){
            Log::info('this unit no order');
            $last_create_number = 1;
        }else{
            Log::info('this unit has order');
            Log::info($last_create_no);
           $last_create_number = $last_create_no->create_no+1;
           
        }

        // foreach( $request->order_items as $item ){
            Log::info($request->order_items);
            Log::info($last_create_number);
            // Log::info($item['sap']);
        try{
            Log::info('create order');
            OrderItem::create([
                'create_no' => $last_create_number,
                'unit_id' => $request->order_items[0]['stock_id'],
                'user_id' => 2,
                'year' => $split_date_now[0],
                'month' => $split_date_now[1],
                'date_order' => $tmp_date_now[0],
                'items' => $request->order_items,
            ]);
        }catch(\Illuminate\Database\QueryException $e){
            //rollback
            return redirect()->back()->whit(['status' => 'error', 'msg' =>  $e->getMessage()]);
        }
       
        return Redirect::back()->with(['status' => 'success', 'msg' => 'สร้างใบสั่งซื้อสำเร็จ']);
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
        $order_lists = OrderItem::with('User:id,name')
                                ->where('unit_id',$division_id)
                                ->orderBy('created_at','desc')
                                ->get();
        // $order_lists = [
        //                 ['id'=>'1','year'=>2021,'month'=>9,'day'=>28,'status'=>'สร้างใบสั่งซื้อ'],
        //                 ['id'=>'2','year'=>2021,'month'=>9,'day'=>25,'status'=>'สร้างใบสั่งซื้อ'],
        //                 ['id'=>'3','year'=>2021,'month'=>8,'day'=>24,'status'=>'รออนุมัติ'],
        //                 ['id'=>'4','year'=>2021,'month'=>7,'day'=>28,'status'=>'ได้รับอนุมัติแล้ว'],
        //                 ['id'=>'5','year'=>2021,'month'=>6,'day'=>27,'status'=>'ตรวจรับพัสดุแล้ว'],
        // ];
        // \Log::info($stocks);
        // \Log::info('------------------------');
        // \Log::info($stock_items);

        foreach ($order_lists as $key=>$order_list) {
            $created_at_tmp =  explode(' ', $order_list['created_at']);
            $split_date_now = explode('-', $created_at_tmp[0]);
            $year = (int) $split_date_now[0] + 543;
            $thaimonth = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
            $created_at_format = $split_date_now[2].'  '.$thaimonth[(int) $split_date_now[1]].' '.$year.' '.$created_at_tmp[1].' น.';
            $order_lists[$key]['created_at_format'] = $created_at_format;
        }


   
 
      

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
    public function update(Request $request)
    {
        //dd($request);
       // Log::info($request->order_id);
       
        $datetime_now = Carbon::now();
        Log::info('datetime_now==>');
      
        Log::info($datetime_now);
        $tmp_date_now = explode(' ', $datetime_now);
        $split_date_now = explode('-', $tmp_date_now[0]);

        $order = OrderItem::find($request->order_id);
        //Log::info($order);
        $last_order_no = OrderItem::select('order_no')
                                ->where('unit_id',$order->unit_id)
                                ->where('year',$split_date_now[0])
                                ->orderBy('order_no','desc')
                                ->first();
        if($last_order_no->order_no == 0){
            Log::info('this unit no order');
            $last_order_number = 1;
        }else{
            Log::info('this unit has order');
            Log::info($last_order_no);
            $last_order_number = $last_order_no->order_no+1;

        }

        Log::info($last_order_number);

        //update order_no
        try{
            Log::info('send order');
            $datetime_send = $tmp_date_now[0].' '.$tmp_date_now[1];
            $timeline = ['send_datetime'=>$datetime_send , 'send_user_id'=>'2'];
            Log::info($timeline);
            $order = OrderItem::find($request->order_id)->update([
                                                                'order_no'=>$last_order_number,
                                                                'status'=>'send',
                                                                'timeline'=>$timeline
                                                            ]);
        }catch(\Illuminate\Database\QueryException $e){
            //rollback
            return redirect()->back()->whit(['status' => 'error', 'msg' =>  $e->getMessage()]);
        }
       
        return Redirect::back()->with(['status' => 'success', 'msg' => 'ส่งใบสั่งซื้อไปสำนักงานภาควิชาฯ เรียบร้อยแล้ว']);

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
