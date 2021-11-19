<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

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
        
        //return "store";
        $order = OrderItem::find($request->order_id);
          //  Log::info($order->items);

        foreach($order->items as $item ){
            Log::info($item);
            // 'stock_id' => 1,
            // 'id' => 4,
            // 'sap' => '40017208',
            // 'item_name' => 'LIAISON Direct Renin_100 Test',
            // 'unit' => '3',
            // 'price' => '50000',
            // 'business_id' => 6,
            // 'business_name' => 'บจ.บ้านพุทธรักษา 2015 จำกัด',
            // 'total' => 150000,
            // 'catalog_number' => 'ACTH102',
            // 'lot_number' => '396A',
        }
        // try{
        //         ItemTransaction::create([
        //                                 'stock_id'=>$stock_item->stock_id ,
        //                                 'stock_item_id'=>$stock_item->id ,
        //                                 'user_id'=>1,
        //                                 'year'=>$year_checkout,
        //                                 'month'=>$month_checkout,
        //                                 'date_action'=>$request->date,
        //                                 'action'=>'checkout',
        //                                 'item_count'=>$request->unit,
        //                             ]);

        // }catch(\Illuminate\Database\QueryException $e){
        //     //rollback
        //     return redirect()->back();
        // }

        // $balance = $stock_item->item_sum - $request->unit;
        // Log::info($balance);
        // try{
        //     StockItem::whereSlug($request->item_slug)->update(['item_sum'=>$balance]);
        // }catch(\Illuminate\Database\QueryException $e){
        //      //rollback
        //     //return redirect()->back();
        //     return Redirect::back()->withErrors(['status' => 'error', 'msg' => $e->getMessage()]);
        // }

        // $stock_items = StockItem::with('unitCount:id,countname')
        //                             ->where('stock_id',$request->stock_id)->get();
      
        return Redirect::back()->with(['status' => 'success', 'msg' => 'บันทึกรับพัสดุใหม่ลงคลังสำเร็จ']);
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
