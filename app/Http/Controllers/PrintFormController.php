<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\budget;
use App\Models\OrderItem;
use App\Models\OrderPurchase;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Unit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        $head = 'แบบฟอร์มรายการสั่งซื้อวัสดุ(แบบสัญญา)ของ สาขา/หน่วยงาน';
        $title = $head.'  '.$division_name;
        // $pdf->Cell(0,0,'Hello World',0,0,'C');
        // $pdf->Ln(5);
        $pdf->Cell(0,0,iconv('UTF-8', 'cp874', $title),0,0,'C');

        $pdf->SetFont('THSarabunNew');
        $pdf->SetFontSize('16'); 
        $pdf->SetXY(20, 19);
        $pdf->Cell(25,10,iconv('UTF-8', 'cp874', 'รายการที่ 1'));

       // $pdf->SetTitle('แบบฟอร์มรายการสั่งซื้อวัสดุของ สาขา/หน่วยงาน');
       
       
        $pdf->Output('I');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(OrderItem $order)
    {
           //Log::info($order->items);


          $pdf = new FPDI('l');
          $pdf->AddPage();
          $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
          $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
  
          // add  image watermark
         // $pdf->Image('https://a7sas.net/wp-content/uploads/2019/07/4060.jpeg',60,30,90,0);
        // $pdf->Image(storage_path('images/logo_med_tranparent.gif'),60,30,90,0,'GIF');
         $pdf->Image(storage_path('app/public/images/watermark_medstock.png'),20,30,0,0,'png');
          
          //title
          $pdf->SetFont('THSarabunNew','B');
          $pdf->SetFontSize('20'); 
          $unit = Unit::where('unitid',$order->items[0][0]['stock_id'])->first();
        //  Log::info($unit);
          $division_name = $unit->unitname;
          $head = 'แบบฟอร์มบันทึกการรับพัสดุ สาขา/หน่วยงาน';
          $title = $head.'  '.$division_name;
          $pdf->Cell(0,15,iconv('UTF-8', 'cp874', $title),0,0,'C');
  
   
          //head column
          $pdf->SetFont('THSarabunNew','B');
          $pdf->SetFontSize('16'); 
          $pdf->SetXY(18, 25);
         // $pdf->SetLineWidth(2);
          // $pdf->Line(10,50,10,50);
          $pdf->SetLineWidth(1);
          $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'ลำดับ    รหัส              ชื่อ                                               บริษัทผู้ขาย                                               วันที่รับเข้า               จำนวนสั่งซื้อ        คงเหลือ           '),'B');
       
          //list item
          $pdf->SetFont('THSarabunNew');
          $pdf->SetFontSize('16'); 
          $total_all = 0;
          $x=20;
          $y=35;
          $pdf->SetXY($x, $y);
          $pdf->SetLineWidth(0.2);
         // Log::info($order->timeline['checkin_datetime']);
          foreach($order->items as $index=>$item){
              //Log::info('stock_item_id->'.$item['id']);
              $i = $index;
              $index = $index+1;
              if(strlen($item[0]['item_name'])>30){
                $pdf->SetFontSize('12'); 
              }
              $item_print = $index.'. '.$item[0]['sap'].'    '.$item[0]['item_name'];
              $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $item_print),'B');
             
              
              if(strlen($item[0]['business_name'])>100){
                  $pdf->SetFontSize('12'); 
              }
              $pdf->SetXY(110, $y);
              $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $item[0]['business_name']));

              $pdf->SetFontSize('16');
              $pdf->SetXY(200, $y);
              $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $order->timeline['checkin_datetime']));
  
              $pdf->SetFontSize('16');
              $pdf->SetXY(243, $y);
              $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $item[0]['order_input']));

              //จำนวนคงเหลือ
              //$item_sum = StockItem::select('item_sum')->whereId($item[0]['id'])->first();
             // Log::info('item_sum->'.$order->timeline['item_sum_old'][$i]);
              $item_sum = $item[0]['order_input']+$order->timeline['item_sum_old'][$i];
              $pdf->SetXY(268, $y);
              $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $item_sum));

          
            //   $pdf->SetXY(250, $y);
            //   $pdf->Cell(0,10,iconv('UTF-8', 'cp874', number_format($item[0]['total'],2)));
  
              $total_all = $total_all+$item[0]['total'];
              $y = $y+10;
              $pdf->SetXY($x, $y);
          }
  
        //   $pdf->SetXY(225, $y);
        //   $total_all_print = 'รวมเป็นเงิน  '.number_format($total_all,2).'  บาท';
        //   $pdf->SetFont('THSarabunNew','B');
        //   $pdf->SetFontSize('18'); 
        //   $pdf->Cell(0,15,iconv('UTF-8', 'cp874', $total_all_print));
  
          $y = $y+50;
          $pdf->SetFont('THSarabunNew');
          $pdf->SetFontSize('16'); 
          $pdf->SetXY(20, $y);
          $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'ลงชื่อ................................................เจ้าหน้าที่สโตร์/ผู้รับผิดชอบ'));
          $y = $y+10;
          $pdf->SetXY(20, $y);
          $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '      (                                            )'));
          $y = $y+10;
          $pdf->SetXY(20, $y);
          $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '         วันที่......................................'));
  
       
  
          $y = 100;
          $pdf->SetXY(180, $y);
          $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '          ลงนาม................................................หัวหน้าห้องปฎิบัติการ'));
          $y = $y+10;
          $pdf->SetXY(180, $y);
          $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '                  (                                             )'));
          $y = $y+10;
          $pdf->SetXY(180, $y);
          $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '                  วันที่......................................'));
  
          
          // วันเวลาที่พิมพ์
          $mutable = Carbon::now();
          //\Log::info($mutable);
          $tmp_date_now = explode(' ', $mutable);
          $split_date_now = explode('-', $tmp_date_now[0]);
          $year = (int) $split_date_now[0] + 543;
          $thaimonth = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
          $date_now_show = $split_date_now[2].'  '.$thaimonth[(int) $split_date_now[1]].' '.$year;
  
          $pdf->SetFontSize('14');
          $pdf->SetXY(200,3);
          $date_print = 'วันเวลาที่พิมพ์'.'  '.$date_now_show.'  '.$tmp_date_now[1].' น.';
          $pdf->Cell(0, 10, iconv('UTF-8', 'cp874', $date_print), 0, 0, 'R');

          $pdf->SetXY(10,3);
          $date_print = 'อ้างอิงจากเลขที่ใบสั่งซื้อ:'.'  '.$order['create_no'].'/'.$order['year'];
          $pdf->Cell(0, 10, iconv('UTF-8', 'cp874', $date_print), 0, 0, 'L');
  
          //test font color
          // $pdf->SetFontSize('50');
          // $pdf->SetTextColor(255,192,203);
          // $pdf->SetXY(100,100);
          // $pdf->Cell(0,15,iconv('UTF-8', 'cp874', 'TEST  TEST'));
  
          $pdf->Output('I');
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
        
       // Log::info($order);
       // Log::info($order->items);


        $pdf = new FPDI('l');
        $pdf->AddPage();
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');

        // add  image watermark
       $pdf->Image(storage_path('app/public/images/watermark_medstock.png'),20,30,0,0,'png');
        
        //title
        $pdf->SetFont('THSarabunNew','B');
        $pdf->SetFontSize('20'); 
        $unit = Unit::where('unitid',$order->items[0][0]['stock_id'])->first();
        //Log::info($unit);
        $division_name = $unit->unitname;
        $head = 'แบบฟอร์มรายการสั่งซื้อวัสดุ(แบบสัญญา)ของ สาขา/หน่วยงาน';
        $title = $head.'  '.$division_name;
        $pdf->Cell(0,15,iconv('UTF-8', 'cp874', $title),0,0,'C');

 
        //head column
        $pdf->SetFont('THSarabunNew','B');
        $pdf->SetFontSize('16'); 
        $pdf->SetXY(18, 25);
        $pdf->SetLineWidth(2);
        // $pdf->Line(10,50,10,50);
        $pdf->SetLineWidth(1);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'ลำดับ    รหัส              ชื่อ                                               บริษัทผู้ขาย                                   จำนวนสั่งซื้อ      มูลค่า(บาท)/หน่วย           รวม'),'B');
     
        //list item
        $pdf->SetFont('THSarabunNew');
        $pdf->SetFontSize('16'); 
        $total_all = 0;
        $x=20;
        $y=35;
        $pdf->SetXY($x, $y);
        $pdf->SetLineWidth(0.1);
        foreach($order->items as $index=>$item){
            $index = $index+1;
            if(strlen($item[0]['item_name'])>30){
                $pdf->SetFontSize('12'); 
            }
            $item_print = $index.'. '.$item[0]['sap'].'    '.$item[0]['item_name'];
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $item_print),'B');
           
            
            if(strlen($item[0]['business_name'])>100){
                $pdf->SetFontSize('12'); 
            }
            $pdf->SetXY(110, $y);
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $item[0]['business_name']));

            $pdf->SetFontSize('16');
            $pdf->SetXY(200, $y);
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $item[0]['order_input']));
        
            $pdf->SetXY(215, $y);
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', number_format($item[0]['price'],2)));

            $pdf->SetXY(250, $y);
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', number_format($item[0]['total'],2)));

            $total_all = $total_all+$item[0]['total'];
            $y = $y+10;
            $pdf->SetXY($x, $y);
        }

        $pdf->SetXY(225, $y);
        $total_all_print = 'รวมเป็นเงิน  '.number_format($total_all,2).'  บาท';
        $pdf->SetFont('THSarabunNew','B');
        $pdf->SetFontSize('18'); 
        $pdf->Cell(0,15,iconv('UTF-8', 'cp874', $total_all_print));

        $y = $y+50;
        $pdf->SetFont('THSarabunNew');
        $pdf->SetFontSize('16'); 
        $pdf->SetXY(20, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'ลงชื่อ................................................'));
        $y = $y+10;
        $pdf->SetXY(20, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '            เจ้าหน้าที่พัสดุสาขา'));

        $y = $y+14;
        $pdf->SetXY(20, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'ลงชื่อ................................................'));
        $y = $y+10;
        $pdf->SetXY(20, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '            ผู้ตรวจสอบสาขา'));

        $y = 120;
        $pdf->SetXY(180, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '           ................................................'));
        $y = $y+10;
        $pdf->SetXY(180, $y);
        $approve_name = config('app.APPROVE_NAME');
        $approve_name_print = 'ลงชื่อ  '.$approve_name;
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $approve_name_print));
        $y = $y+10;
        $pdf->SetXY(180, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', '             หัวหน้าภาควิชาอายุรศาสตร์'));

        
        // วันเวลาที่พิมพ์
        $mutable = Carbon::now();
        //\Log::info($mutable);
        $tmp_date_now = explode(' ', $mutable);
        $split_date_now = explode('-', $tmp_date_now[0]);
        $year = (int) $split_date_now[0] + 543;
        $thaimonth = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        $date_now_show = $split_date_now[2].'  '.$thaimonth[(int) $split_date_now[1]].' '.$year;

        $pdf->SetFontSize('14');
        $pdf->SetXY(200,3);
        $date_print = 'วันเวลาที่พิมพ์'.'  '.$date_now_show.'  '.$tmp_date_now[1].' น.';
        $pdf->Cell(0, 10, iconv('UTF-8', 'cp874', $date_print), 0, 0, 'R');

        $pdf->SetXY(10,3);
        $date_print = 'เลขที่ใบสั่งซื้อ:'.'  '.$order['create_no'].'/'.$order['year'];
        $pdf->Cell(0, 10, iconv('UTF-8', 'cp874', $date_print), 0, 0, 'L');
        //test font color
        // $pdf->SetFontSize('50');
        // $pdf->SetTextColor(255,192,203);
        // $pdf->SetXY(100,100);
        // $pdf->Cell(0,15,iconv('UTF-8', 'cp874', 'TEST  TEST'));

        $pdf->Output('I');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printBudgetOrder($stock_id,$year)
    {
        // Log::info('printBudgetOrder');
        // Log::info($stock_id);
        // Log::info($year);
       // return "printBudgetOrder";

        //$stock = Stock::whereId($stock_id)->get();
        $use_budget=0;
        $balance_budget=0.0;
       
        $budget_year = budget::where('stock_id',$stock_id)
                                            ->where('year',$year)
                                            ->where('status','on')          
                                            ->first();
     
        
        //$pdf = new FPDI('l'); //แนวนอน
        $pdf = new FPDI();
        $pdf->AddPage();
        $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
        $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');

        // add  image watermark
       $pdf->Image(storage_path('app/public/images/watermark_medstock.png'),7,15,0,0,'png');
        
        //title
        $pdf->SetFont('THSarabunNew','B');
        $pdf->SetFontSize('18'); 
        $unit = Unit::where('unitid',$stock_id)->first();
        //Log::info($unit);
        $division_name = $unit->unitname;
        $head = 'รายงานการเบิกงบประมาณการสั่งซื้อวัสดุของ สาขา/หน่วยงาน';
        $title = $head.'  '.$division_name;
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $title),0,0,'C');
        
        $pdf->SetXY(18, 15);
        $year_print = $year+543;
        $title2 = 'ปีงบประมาณ  '.$year_print.' ได้รับงบ '.number_format($budget_year->budget_add,2).'  บาท';
        $pdf->Cell(0,15,iconv('UTF-8', 'cp874', $title2),0,0,'C');
 
        //head column
        $pdf->SetFont('THSarabunNew','B');
        $pdf->SetFontSize('16'); 
        $pdf->SetXY(12, 27);
        $pdf->SetLineWidth(1);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'ลำดับ             เลขที่ใบสั่งซื้อ                    วันที่สั่งซื้อ                                      ใช้งบไป(บาท)'),'B');
        
       
        //**************************order list
        $pdf->SetFont('THSarabunNew','U');
        $pdf->SetXY(13, 38);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'ใบสัญญาสั่งซื้อ'),0,0);

        $thaimonth = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        $y=45;
        $x=15;
        $pdf->SetFont('THSarabunNew');
        $pdf->SetXY($y, $x);
       // $pdf->SetLineWidth(0.1);
        $pdf->SetLineWidth(0.1);
        $stock_orders = OrderItem::where('unit_id',$stock_id)
                                    ->where('year',$year)
                                    ->whereIn('status',['approve','checkin'])
                                    ->orderBy('date_order')
                                    ->get();
      //  if( $stock_orders->count()!=0){
            $seq = 0;
            foreach($stock_orders as $order){
                $seq++;
               // Log::info($order->timeline['approve_budget']);
                $use_budget += $order->timeline['approve_budget'];
                $pdf->SetXY($x, $y);
                $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $seq),'B'); //print line buttom

                $pdf->SetXY(40, $y);
                $order_no = $order->create_no."/".$order->year;
                $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $order_no));

                $pdf->SetXY(85, $y);
                $split_date_order = explode('-', $order->date_order);
                $year_order = (int) $split_date_order[0] + 543;
                $date_order_show = $split_date_order[2].'  '.$thaimonth[(int) $split_date_order[1]].' '.$year_order;
                $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $date_order_show));

                $pdf->SetXY(150, $y);
                $pdf->Cell(0,10, number_format($order->timeline['approve_budget'],2));
               
                $y = $y+10;
                $pdf->SetXY($x, $y);
                // $pdf->SetXY(18, 50);
                // $pdf->SetLineWidth(1);
            }

           
            $pdf->SetFont('THSarabunNew','U');
            $pdf->SetXY(130, $y);
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'รวม '));
            $pdf->SetXY(150, $y);
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', number_format($use_budget,2).'   บาท'));
           
             //$pdf->Line(10,0,20,0);
        // }else{
        //      $use_budget = 0.0;
        // }

        //**************************purchase order list
        $y = $y+10;
        $pdf->SetFont('THSarabunNew','U');
        $pdf->SetXY(13, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'ใบสั่งซื้อ'),0,0);
        
        $purchase_orders = OrderPurchase::where('unit_id',$stock_id)
                                ->where('year',$year)
                                ->whereIn('status',['approved','checkin'])
                                ->orderBy('date_order')
                                ->get();

        $y = $y+10;
        $seq = 0;
        $pdf->SetFont('THSarabunNew');
        $use_budget_purchase = 0;
        foreach($purchase_orders as $porder){
            $seq++;
            // Log::info($order->budget);
            $use_budget_purchase += $porder->budget;
            $pdf->SetXY($x, $y);
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $seq),'B'); //print line buttom

            $pdf->SetXY(40, $y);
            if($porder->order_no==0)
                $order_no = "-";
            else
                $order_no = $porder->order_no;
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $order_no));

            $pdf->SetXY(85, $y);
            $split_date_order = explode('-', $porder->date_order);
            $year_porder = (int) $split_date_order[0] + 543;
            $date_porder_show = $split_date_order[2].'  '.$thaimonth[(int) $split_date_order[1]].' '.$year_porder;
            $pdf->Cell(0,10,iconv('UTF-8', 'cp874', $date_porder_show));

            $pdf->SetXY(150, $y);
            $pdf->Cell(0,10, number_format($porder->budget,2));

            $y = $y+10;
            $pdf->SetXY($x, $y);
            // $pdf->SetXY(18, 50);
            // $pdf->SetLineWidth(1);
        }
     
        $balance_budget = (float)$budget_year->budget_add - (float)$use_budget - (float)$use_budget_purchase;
        $y = $y+10;
        $pdf->SetFont('THSarabunNew','U');
        $pdf->SetXY(130, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'รวม '));
        $pdf->SetXY(150, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', number_format($use_budget_purchase,2).'   บาท'));

        $pdf->SetFont('THSarabunNew');
        $y = $y+10;
        $pdf->SetXY(125, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', 'งบคงเหลือ '));
        $pdf->SetXY(150, $y);
        $pdf->Cell(0,10,iconv('UTF-8', 'cp874', number_format($balance_budget,2).'   บาท'));
        $y = $y+8;
        //$pdf->SetXY(145, $y);
        $pdf->Line(125,$y,180,$y);
        $y = $y+1;
        //$pdf->SetXY(145, $y);
        $pdf->Line(125,$y,180,$y);

         // วันเวลาที่พิมพ์
         $mutable = Carbon::now();
         //\Log::info($mutable);
         $tmp_date_now = explode(' ', $mutable);
         $split_date_now = explode('-', $tmp_date_now[0]);
         $year = (int) $split_date_now[0] + 543;
         $thaimonth = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
         $date_now_show = $split_date_now[2].'  '.$thaimonth[(int) $split_date_now[1]].' '.$year;
 
         $pdf->SetFontSize('12');
         $pdf->SetXY(190,3);
         $date_print = 'ข้อมูล ณ วันเวลาที่พิมพ์'.'  '.$date_now_show.'  '.$tmp_date_now[1].' น.';
         $pdf->Cell(0, 10, iconv('UTF-8', 'cp874', $date_print), 0, 0, 'R');
 
        
        
        $pdf->Output('I');
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
