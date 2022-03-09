<?php

namespace App\APIs;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class CatFood 
{
    
    public function FoodForCat($my_meal,$foods)
    {
       // $my_meal = 6;
       // $foods = ['อาหารเม็ด','อาหารเม็ด','แซลมอนธรรมชาติ','แซลมอนธรรมชาติ', 'แซลมอนธรรมชาติ', 'เนื้อแองกัส'];
        $cat_food_resulte = $this->CalculateFoodForCat($my_meal,$foods);
        print_r($cat_food_resulte);
    }
    public function FoodForCatTest()
    {
        $my_meal = 6;
        $foods = ['อาหารเม็ด','อาหารเม็ด','แซลมอนธรรมชาติ','แซลมอนธรรมชาติ', 'แซลมอนธรรมชาติ', 'เนื้อแองกัส'];
        $cat_food_resulte = $this->CalculateFoodForCat2($my_meal,$foods);
        //print_r($cat_food_resulte);
    }
    private function CalculateFoodForCat2($meal,$foods)
    {
        $i=0;
        $f=0;
        $manage_food=[];
     //   foreach($foods as $key => $food){
            do{
                if($i==0){
                    $manage_food[$i] = $foods[$f];
                    array_splice($foods, $f, 1);
                    print("==>".$i."\n");
                    print_r($manage_food);
                    $i++;
                    $f++;
                    print("i=".$i."\n");
                    print("---------------------------\n");
                }else{
                  
                  //  print_r($manage_food);
                  
                    if(count($foods)>=0){
                        print("i=[".$i."]  f=[".$f."]\n");
                        $count_food=count($foods);
                        print("count foods=".count($foods)."\n");
                        if($f>$count_food){
                            $f=0;
                            print("#####i=[".$i."]  f=[".$f."]\n");
                        }
                          

                        
                           print_r($foods);
                            print("COMPARE==>");
                           print($manage_food[$i-1]);
                           print("----".$foods[$f]."\n");
                        if($manage_food[$i-1]==$foods[$f])
                        {
                            print("dup food dup fooddup fooddup fooddup food\n");
                            //if($f<$count_food)
                            print("count foods=".count($foods)."\n");
                            print("f index=".$f."\n");
                            $f++;
                            //continue;
                        }
                        else{
                            // if($f==$count_food){
                            //     $f=0;
                            //     print("!!!!!!!!!  i=[".$i."]  f=[".$f."]\n");
                            // }
                            print_r($foods[$f]);
                            $manage_food[$i] = $foods[$f];
                            array_splice($foods, $f, 1);
                            print("\n------------cat food>>>");
                            print_r($manage_food);
                            $i++;
                            print("food index=".$f."\n");
                            print_r($foods);
                            print("\n\n\n");
                            if($f == count($foods)){
                                $f=0;
                                print("ffffffffff==".$f);
                            }
                           // $f++;
                        }
                    }
                
                    print("\n++++++++++++++++++++++++++++++++++++\n");
                }
                
                print("i=[".$i."] i=[".$i."] meal=[".$meal."]\n");
              
                
            }while($i<$meal+1);
            
      //  }
        //print_r($manage_food);
    }
    private function CalculateFoodForCat($meal,$foods)
    {
        // if($meal != count($foods))
        //     return false;
        print_r(array_count_values($foods));
        print("\n");
        $count_type_food = count(array_count_values($foods));
        print($count_type_food."\n");
        
        $box_foods=array();
        foreach($foods as $key => $food){
            // $box_foods[$key]['food'] = $food;
            // $box_foods[$key]['used'] = false;
            $box_foods[$key] = array(
                'food' => $food,
                'used' => 'false'
            );
        }
         print_r($box_foods);
        print("\n");

        $manage_food=[];
        $i=0;
        foreach($box_foods as $key => $box_food){
            print($box_food['food']."\n");
           do{
               if( ($box_food['used']=='false') && ($box_food[$key-1] != $box_food['food']) )
               {
                    $manage_food[$i] = $box_food['food'];
                    $box_food[$key]['used'] = 'true';
               }
                 

                print_r($manage_food);
           }while($i==$meal);
          
           print_r($box_food[$key]);
          $i++;
        }
        
       // print_r($manage_food);
        return $foods;
    }
}