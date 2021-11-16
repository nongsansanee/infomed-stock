<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class PrintFormController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
       // $pdf = new setasign\Fpdi\Fpdi();
    

        //$pdf = new FPDF();
        $pdf = new FPDI('l');
        $pdf->AddPage();
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');

        $pdf->SetFont('THSarabunNew','B');
        $pdf->SetFontSize('16'); 

        //title
        $division_name = 'สาขาวิชาการบริบาลผู้ป่วยนอก';
        $head = 'แบบฟอร์มรายการสั่งซื้อวัสดุของ สาขา/หน่วยงาน';
        $title = $head.'  '.$division_name;
        // $pdf->Cell(0,0,'Hello World',0,0,'C');
        // $pdf->Ln(5);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', $title),0,0,'C');

        $pdf->SetFont('THSarabunNew');
        $pdf->SetFontSize('16'); 
        $pdf->Ln(6);
        $pdf->Cell(25,10,iconv('UTF-8', 'cp874', 'รายการที่ 1'));

       // $pdf->SetTitle('แบบฟอร์มรายการสั่งซื้อวัสดุของ สาขา/หน่วยงาน');
       
       
        $pdf->Output();
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
