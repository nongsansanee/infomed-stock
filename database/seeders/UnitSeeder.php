<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = array(
            ['unitid' => '99', 'unitname' => 'สำนักงานภาควิชาอายุรศาสตร์','unittype'=>'1'],
            ['unitid' => '27', 'unitname' => 'หน่วยงบประมาณและพัสดุ','unittype'=>'1'],
            ['unitid' => '33', 'unitname' => 'หน่วยเวชสารสนเทศและบริหารข้อมูล','unittype'=>'1'],
            ['unitid' => '1', 'unitname' => 'สาขาวิชาการบริบาลผู้ป่วยนอก','unittype'=>'2'],
            ['unitid' => '2', 'unitname' => 'สาขาวิชาความดันโลหิตสูง','unittype'=>'2'],
            ['unitid' => '3', 'unitname' => 'สาขาวิชาเคมีบำบัด','unittype'=>'2'],
            ['unitid' => '4', 'unitname' => 'สาขาวิชาต่อมไร้ท่อ','unittype'=>'2'],
        );

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
