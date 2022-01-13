<?php

namespace App\Http\Controllers;

use App\Models\budget;
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


        $stocks = Stock::where('status','1')
                        ->get();

        foreach($stocks as $key=>$stock){
            $budget_year = budget::where('stock_id',$stock->id)
                                            ->where('year','2022')
                                            ->where('status','on')          
                                            ->first();
            Log::info($budget_year);
            if(!$budget_year){
               
                $budget_year['budget']['budget_add']=0.00;
                // $budget_year=[
                //             {'budget_add'=>'0'},
                //     ];
                Log::info($budget_year);
            }
            $stocks[$key]['budget'] = $budget_year;
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
