<?php

namespace App\Http\Controllers;

use App\Models\budget;
use App\Models\OrderItem;
use App\Models\Stock;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year_send= array();
      
        $year_start = budget::select('year')->orderBy('year','asc')->first();
        $year_start = $year_start->year - 1;
      
        array_push($year_send,$year_start);

        $budget_years = budget::select('year')->distinct()->get();
    
        foreach($budget_years as  $year){
           // Log::info($year->year);
           array_push($year_send,$year->year);
          // Log::info($year_send);
        }

        $year_end = budget::select('year')->orderBy('year','desc')->first();
        $year_end = $year_end->year + 1;
        array_push($year_send,$year_end);
        //Log::info($year_send);
        return Inertia::render('Admin/ListBudget',[
                            'years'=>$year_send,
                           
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
        Log::info($request);
        $user = Auth::user();
      //  return ' BudgetController store';
        try{
           // budget::latest()->first();
            budget::create([
                    'stock_id'=>$request->stock_id,
                    'year'=>$request->budget_year,
                    'budget_add'=>$request->budget_input,
                    'status'=>'on',
                    'user_id'=> $user->id
            ]);
        }catch(\Illuminate\Database\QueryException $e){
            //rollback
            Log::info($e->getMessage());
            return redirect()->back()->with(['status' => 'error', 'msg' =>  'เกิดความผิดพลาดในการบันทึกข้อมูลกรุณาติดต่อเจ้าหน้าที่ IT ที่น่ารัก']);
        }
       
        return Redirect::back()->with(['status' => 'success', 'msg' => 'บันทึกงบประมาณสำเร็จ']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($year)
    {
        //Log::info($year);
       // $year = $request->year_selected;
        Log::info($year);
       // return "test";
        $stocks = Stock::where('status','1')->get();
        $use_budget=0;
        $balance_budget=0.0;
        foreach($stocks as $key=>$stock){
            $budget_year = budget::where('stock_id',$stock->id)
                                            ->where('year',$year) 
                                            ->first();
                                          //  ->where('status','on')    
           // Log::info($budget_year->count());
 
            if(!$budget_year){
               
                $budget_year['budget_add']=0.00;
                $budget_year['year']=0;
                $balance_budget = 0.0;
               // Log::info($budget_year);
            }else{
                $stock_orders = OrderItem::where('unit_id',$stock->id)
                                            ->where('year',$year)
                                            ->whereIn('status',['approve','checkin'])
                                            ->get();
                if( $stock_orders->count()!=0){
                    foreach($stock_orders as $order){
                         Log::info($order->timeline['approve_budget']);
                        $use_budget += $order->timeline['approve_budget'];
                    }
                }else{
                    $use_budget = 0.0;
                }
              //  Log::info($budget_year->budget_add);
                $balance_budget = (float)$budget_year->budget_add - (float)$use_budget;
              //  Log::info($balance_budget);
                $stocks[$key]['orders'] = $stock_orders;
                $stocks[$key]['use_budget'] = $use_budget;
                $stocks[$key]['balance_budget'] = $balance_budget;
            }
          
            $stocks[$key]['budget'] = $budget_year;
             //Log::info($stock->unit_id);

        }
        return response()->json([
            'stocks' => $stocks
        ]);
        // return Inertia::render('Admin/ListBudget',[
        //     // 'budgets'=>$budgets,
        //     'stock_budgets'=>$stocks,
        // ]);
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
