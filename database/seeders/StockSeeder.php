<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stocks = array(
            ['stockname' => 'คลังพัสดุทางการแพทย์ของสาขาวิชาการบริบาลผู้ป่วยนอก', 'stockengname' => 'stock office', 'user_id' => '1'],
            ['stockname' => 'คลังพัสดุทางการแพทย์ของสาขาวิชาความดันโลหิตสูง', 'stockengname' => 'Medical Hypertension ', 'user_id' => '1'],
            ['stockname' => 'คลังพัสดุทางการแพทย์ของสาขาวิชาเคมีบำบัด', 'stockengname' => 'Medical Oncology', 'user_id' => '1'],
            ['stockname' => 'คลังพัสดุทางการแพทย์ของสาขาวิชาต่อมไร้ท่อ', 'stockengname' => 'Medical Endocrin', 'user_id' => '1'],
           
        );

        foreach ($stocks as $stock) {
            Stock::create([
                           'stockname' => $stock['stockname'],
                           'stockengname'=> $stock['stockengname'],
                           'user_id'=> $stock['user_id'],
                        ]);
        }

    }
}
