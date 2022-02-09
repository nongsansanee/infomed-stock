<?php

namespace App\APIs;

class ExamArraySort
{
    public function SortLogByDate()
    {

  
        $logs = [
            '2022-01-15' => [
            'send' => 240,
            'accept' => 191,
            'duplicate_error' => 17,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 32,
            'response_error' => 0,
            ],
            '2022-01-16' => [
            'send' => 213,
            'accept' => 158,
            'duplicate_error' => 55,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-17' => [
            'send' => 298,
            'accept' => 255,
            'duplicate_error' => 42,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 1,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-18' => [
            'send' => 321,
            'accept' => 294,
            'duplicate_error' => 27,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-19' => [
            'send' => 295,
            'accept' => 211,
            'duplicate_error' => 84,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-20' => [
            'send' => 300,
            'accept' => 233,
            'duplicate_error' => 67,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-21' => [
            'send' => 309,
            'accept' => 276,
            'duplicate_error' => 33,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-22' => [
            'send' => 240,
            'accept' => 188,
            'duplicate_error' => 52,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-23' => [
            'send' => 187,
            'accept' => 139,
            'duplicate_error' => 47,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-24' => [
            'send' => 309,
            'accept' => 275,
            'duplicate_error' => 34,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
            '2022-01-25' => [
            'send' => 355,
            'accept' => 326,
            'duplicate_error' => 29,
            'invalid_symp_code_error' => 0,
            'other_validation_error' => 0,
            'request_error' => 0,
            'response_error' => 0,
            ],
        ];

  

        ksort($logs);

        foreach($logs as $x=>$x_value)
        {
            //echo "Key=" . $x . " , \n Value=" . $x_value['send'];
            echo "DATE=>" . $x  ;
            foreach($x_value as $y=>$y_value)
            {
                echo "\n Key=" . $y . " ,  Value=" . $y_value;
            }
            echo "\n";
        }

     
    }
}