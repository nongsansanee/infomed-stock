<?php

namespace App\Http\Controllers;

use App\Models\budget;
use App\Models\OrderItem;
use App\Models\Stock;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        //return "budget list test";
        // $budgets = budget::where('status','on')
        //                 ->with('stock:id,stockname')
        //                 ->get();


        $stocks = Stock::where('status','1')->get();
        $use_budget=0;
        $balance_budget=0.0;
        foreach($stocks as $key=>$stock){
            $budget_year = budget::where('stock_id',$stock->id)
                                            ->where('year','2022')
                                            ->where('status','on')          
                                            ->first();
            //Log::info($budget_year);
            foreach($stock->orderItems as $order){
                // Log::info($order->timeline['approve_budget']);
                 $use_budget += $order->timeline['approve_budget'];
            }

          
            if(!$budget_year){
               
                $budget_year['budget_add']=0.00;
                $budget_year['year']=0;
                $balance_budget = 0.0;
               // Log::info($budget_year);
            }else{
                Log::info($budget_year->budget_add);
                $balance_budget = (float)$budget_year->budget_add - (float)$use_budget;
                Log::info($balance_budget);
            }
          
            $stocks[$key]['budget'] = $budget_year;
             //Log::info($stock->unit_id);
           
         
            
             
           $stocks[$key]['orders'] = $stock->orderItems;
           $stocks[$key]['use_budget'] = $use_budget;
           $stocks[$key]['balance_budget'] = $balance_budget;
        }
        return Inertia::render('Admin/ListBudget',[
                           // 'budgets'=>$budgets,
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
