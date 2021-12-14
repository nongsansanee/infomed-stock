<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemTransaction;
use App\Models\OrderItem;
use App\Models\StockItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CheckInOrderController extends Controller
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
         Log::info($request->order_id);
       

         $order = OrderItem::find($request->order_id);
         Log::info($order->year);
         Log::info($order->month);
        //return "store";
      
          //  Log::info($order->items);
          $datetime_now = Carbon::now();
          // Log::info('datetime_now==>');
        
         
          $tmp_date_now = explode(' ', $datetime_now);
           Log::info($tmp_date_now);
         // $split_date_now = explode('-', $tmp_date_now[0]);

        foreach($order->items as $item ){
            Log::info($item);
          
            try{
                    $profile = [
                                "catalog_number"=>$item['catalog_number'],
                                "lot_number"=>$item['lot_number'],
                                 ];
                    ItemTransaction::create([
                                            'stock_id'=>$item['stock_id'] ,
                                            'stock_item_id'=>$item['id'] ,
                                            'user_id'=>$order->user_id,
                                            'order_item_id'=>$request->order_id,
                                            'year'=>$order->year,
                                            'month'=>$order->month,
                                            'date_action'=>$tmp_date_now[0],
                                            'action'=>'checkin',
                                            'item_count'=>$item['unit'],
                                            'profile'=>$profile
                                        ]);
                    //********update item_sum
                    try{
                        $item_stock = StockItem::select('item_sum')->whereId($item['id'])->first();
                        Log::info($item_stock->item_sum);
                        $balance = $item_stock->item_sum + $item['unit'];
                        Log::info('-->'.$balance);

                        StockItem::whereId($item['id'])->update(['item_sum'=>$balance]);
                       
                        //StockItem::whereId($item->id)->update(['item_sum'=>$balance]);
                    }catch(\Illuminate\Database\QueryException $e){
                        //rollback
                        //return redirect()->back();
                        return Redirect::back()->withErrors(['status' => 'error', 'msg' => $e->getMessage()]);
                    }
                    //*******************update status order to checkin
                   // $order= OrderItem::find($request->order_id);
                    Log::info($order->timeline);
            
                
                    try{
                        Log::info('checkin order');
                        $datetime_send = $tmp_date_now[0].' '.$tmp_date_now[1];
                        $old_timeline = $order->timeline;
                        $old_timeline['checkin_datetime']=$datetime_send;
                        $old_timeline['checkin_user_id']=$order->user_id;
                     
                        Log::info($old_timeline);
                        OrderItem::find($request->order_id)->update([
                                                                    'status'=>'checkin',
                                                                    'timeline'=>$old_timeline
                                                                        ]);
                    }catch(\Illuminate\Database\QueryException $e){
                        //rollback
                        return redirect()->back()->whit(['status' => 'error', 'msg' =>  $e->getMessage()]);
                    }

            }catch(\Illuminate\Database\QueryException $e){
                //rollback
                return redirect()->back();
            }
        }
       
      
        return Redirect::back()->with(['status' => 'success', 'msg' => 'บันทึกรับพัสดุใหม่ลงคลังสำเร็จ']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        Log::info('show checkin order');
       // Log::info($request->all());
        Log::info($order_id);
        // return Inertia::render('Admin/CheckOrder',[
        //     'order_lists'=>$order_lists
        // ]);
        $item_checkin = ItemTransaction::select('stock_item_id')
                                        ->with('stockItem:id,item_code,item_name,item_sum')
                                        ->where('order_item_id',$order_id)
                                        ->where('action','checkin')
                                        ->where('status','active')
                                        ->get();
        Log::info($item_checkin);
        $test=["aaa"=>"1","bbb"=>"2",];

        return Inertia::render('Admin/CheckOrder',[
                 'view_checkin'=>$item_checkin
             ]);
        return 'view checkin order';
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
