<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_lists = [
            ['id'=>'1','updated_at'=>'2021-10-07','unit_name'=>'สาขาวิชาการบริบาลผู้ป่วยนอก','order_no'=>'2565-1-1','status'=>'รออนุมัติ'],
            ['id'=>'2','updated_at'=>'2021-10-06','unit_name'=>'สาขาวิชาความดันโลหิตสูง','order_no'=>'2565-2-1','status'=>'อนุมัติแล้ว'],
            ['id'=>'3','updated_at'=>'2021-10-05','unit_name'=>'สาขาวิชาต่อมไร้ท่อ','order_no'=>'2565-4-1','status'=>'ตรวจรับพัสดุแล้ว'],
    ];
    return Inertia::render('Admin/CheckOrder',[
                    // 'stocks'=>$stocks,
                    // 'stock_items'=>$stock_items,
                    // 'unit'=> $unit,
                    'order_lists'=>$order_lists
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
