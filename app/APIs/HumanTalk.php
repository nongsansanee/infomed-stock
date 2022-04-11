<?php

namespace App\APIs;

class HumanTalk 
{
    private $connectionList = [
        [ 'name' => "จริงใจ", 'connections' => ["กุ๊บกิ๊บ", "พาเพลิน"] ],
        [ 'name' => "กุ๊บกิ๊บ", 'connections' => ["จริงใจ", "นู๋เนย"] ],
        [ 'name' => "พาเพลิน", 'connections' => ["จริงใจ", "อ๋อมแอ๋ม"] ],
        [ 'name' => "อ๋อมแอ๋ม", 'connections' => ["พาเพลิน"] ],
        [ 'name' => "นู๋เนย", 'connections' => ["กุ๊บกิ๊บ", "มะเหมี่ยว"] ],
        [ 'name' => "มะเหมี่ยว", 'connections' => ["นู๋เนย"] ],
    ];
    public function WhoTalk($source,$destination)
    {
        // $source = 'อ๋อมแอ๋ม';
        // $destination = 'นู๋เนย';
        $path = [];
        $has_source=0;
        $has_destination = 0;

        //check source and destination same name
        if($source==$destination)
         return false;

        //check source and destination has connectionList
        foreach($this->connectionList as $connection){
            if(in_array($source, $connection['connections']))
              $has_source = 1;
            
            if(in_array($destination, $connection['connections']))
              $has_destination = 1;  
        }
    

        if(!$has_source || !$has_destination)
            return false;

        array_push($path,$source);

        do{
         
           // print "search-->".$source."\n";
            foreach($this->connectionList as $connection){

               
                 $key = in_array($source, $connection['connections']);
                 //print "----------".$key;
                 if($key){
                    //print $connection['name']."\n";
                    //$source = $connection['name'];
                  //  print "next search-->".$connection['name']."\n";
                    if(!in_array($connection['name'],$path)){
                        array_push($path,$connection['name']);
                       // print_r($path);
                        break;
                    }else{
                        continue;
                    }
                    
                   
                  
                 }    
             }
             $source = $connection['name'];
          
        }while($destination != $source);
  
        if(count($path)>1){
            return $path;
        }else{
            return false;
        }
       
    }
}