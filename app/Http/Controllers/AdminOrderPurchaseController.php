<?php

namespace App\Http\Controllers;

use App\Models\OrderPurchase;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminOrderPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        Log::info($user);

        if($user->profile['division_id'] != 27 )
            $stocks = Stock::where('unit_id',$user->profile['division_id'])->get();
        else
             $stocks = Stock::all();
        return Inertia::render('Admin/AddOrderPurchase',[
                'stocks'=>$stocks,
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
      // Log::info($request->all());
        $user = Auth::user();
       // Log::info($user);
       // Log::info($user->profile['division_id']);
       // return "test";
        // $mutable = Carbon::now();
        // //\Log::info($mutable);
        // $tmp_date_now = explode(' ', $mutable);
        // $split_date_now = explode('-', $tmp_date_now[0]);
        $split_date_order = explode('-',$request->date_purchase);

        try{
          //  Log::info('create order purchase');
            //$split_date_purchase= explode('-',$request->date_purchase);
            if($split_date_order[1] > 9)
                $year_budget = $split_date_order[0] + 1;
            else
                $year_budget = $split_date_order[0];

           // Log::info('year_budget=='.$year_budget);

           if($user->profile['division_id']<19)
           {
                $timeline['create_by']=$user->profile['division_name'];
                $status = 'created';
           }
           else
           {
                $timeline['create_by']='admin';
                $status = 'approved';
           }

            OrderPurchase::create([
                'unit_id' => $request->stock_select['stockid'],
                'user_id' => $user->id,
                'year' => $year_budget,
                'month' => $split_date_order[1],
                'date_order' => $request->date_purchase,
                'project_name' => $request->project_name,
                'budget' => $request->total_budget,
                'items' => $request->preview_orders,
                'status' => $status,
                'timeline' => $timeline,
            ]);
        }catch(\Illuminate\Database\QueryException $e){
            //rollback
            return redirect()->back()->whit(['status' => 'error', 'msg' =>  $e->getMessage()]);
        }
       return Redirect::back()->with(['status' => 'success', 'msg' => 'บันทึกการสั่งซื้อสำเร็จ']);
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
