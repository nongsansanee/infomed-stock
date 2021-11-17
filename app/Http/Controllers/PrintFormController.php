<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
       
       
        $pdf->Output('I');
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
    public function show(OrderItem $order)
    {
        
        Log::info($order);
        Log::info($order->items);


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

       // $pdf->Cell(25,10,iconv('UTF-8', 'cp874', 'รายการที่ 1'));
        //list item
        $total_all = 0;
        $x =80;
        foreach($order->items as $index=>$item){
            $index = $index+1;
            $item_print = $index.'. '.$item['sap'].'    '.$item['item_name'].'    '.$item['business_name'].'    '.$item['unit'].'    '.$item['price'];
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $item_print));
            //$pdf->setX($x);
          //  $pdf->Cell(0,80,iconv('UTF-8', 'cp874', $item['business_name']));
            $pdf->Ln(8);
            $total_all = $total_all+$item['total'];
        }
        $total_all_print = 'รวมเป็นเงิน  '.$total_all.'  บาท';
        // $pdf->Ln(6);
        $pdf->SetFont('THSarabunNew','B');
        $pdf->SetFontSize('16'); 
        $pdf->Cell(100,30,iconv('UTF-8', 'cp874', $total_all_print),0,0,'R');

        $pdf->SetFont('THSarabunNew');
        $pdf->SetFontSize('16'); 
        $pdf->Ln(26);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', 'ลงชื่อ................................................'),0,0,'C');
        $pdf->Ln(6);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', '       เจ้าหน้าที่พัสดุสาขา'),0,0,'C');

        $pdf->Ln(16);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', 'ลงชื่อ................................................'),0,0,'C');
        $pdf->Ln(6);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', '       ผู้ตรวจสอบสาขา'),0,0,'C');

        $pdf->Ln(20);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', '       ................................................'),0,0,'C');
        $pdf->Ln(6);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', 'ลงชื่อ  รองศาสตราจารย์นายแพทย์ไชยรัตน์ เพิ่มพิกุล'),0,0,'C');
        $pdf->Ln(6);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', '         หัวหน้าภาควิชาอายุรศาสตร์'),0,0,'C');

        $pdf->Output('I');
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
