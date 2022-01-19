<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        if(is_string($role)){
            $role = Role::whereName($role)->firstOrCreate(['name'=>$role]);
        }

        $this->roles()->syncWithoutDetaching($role); // เช็คซ้ำให้  sync โดยไม่ตัดของเดิมออก
    }
    
    public function getAbilitiesAttribute()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique()->flatten();
    }
    
    
    public function getWeight($str){
       // $mystring = 'abc';
        $findme1 ='kg';
        $findme2 = 'Kg';
        $findme3 = 'กก';
        $findme4 = ' กก';
        $findme5 = 'นน';
        $findme6 = 'น้ำหนัก';
        $findme7 = 'นำหนัก';

        $test1 = explode($findme1,$str);
        $test2 = explode($findme2,$str);
        $test3 = explode($findme3,$str);
        $test4 = explode($findme4,$str);
        $test5 = explode($findme5,$str);
        $test6 = explode($findme6,$str);
        $test7 = explode($findme7,$str);


        if(count($test1)>1){
            $res = substr($test1[0],-2);
            if( (strpos($test1[0],'.')!== false) && (strpos($test1[0],' ')!== false)){
                Log::info('A test1-->'.$test1[0]);
                $res1 = substr($test1[0],-5);
                return $res1;
            }
            if(strpos($res,'.') !== false){
                $res2 = substr($test1[0],-4);
               
                return $res2;
            }
            if(strpos($res,' ')!== false){
                $res3 = substr($test1[0],-4);
                return $res3;
            }
          
            return $res;
        }

        if(count($test2)>1){
            $res = substr($test2[0],-2);
            if( (strpos($test2[0],'.')!== false) && (strpos($test2[0],' ')!== false)){
                Log::info('A test2-->'.$test2[0]);
                $res1 = substr($test2[0],-5);
                return $res1;
            }
            if(strpos($res,'.')!== false){
                $res2 = substr($test2[0],-4);
                return $res2;
            }
            if(strpos($res,' ')!== false){
                $res3 = substr($test2[0],-4);
                return $res3;
            }
            return $res;
        }

        if(count($test3)>1){ //กก
            $res = substr($test3[0],-2);
            Log::info('res-->['.$res.']');
            Log::info('test3[0]-->['.$test3[0].']');
            // if((strpos($test3[0],'กก') === false) && (strpos($test3[1],'กก') === false)){
            //     return false;
            // }

            if( (strpos($test3[0],'.')!== false) && (strpos($test3[0],' ')!== false)){
                Log::info('A test3-->'.$test3[0]);
                $res1 = substr($test3[0],-5);
                return $res1;
            }

            if(strpos($res,'.')!== false){
                Log::info('B test3-->'.$test3[0]);
                $res2 = substr($test3[0],-4);
                return $res2;
            }

            if(strpos($res,' ')!== false){
                Log::info('C test3-->'.$test3[0]);
                $res3 = substr($test3[0],-4);
                return $res3;
            }
            return $res;
        }

        if(count($test4)>1){
            $res = substr($test4[0],-2);
            Log::info('res-->['.$res.']');
            Log::info('test4[0]-->['.$test4[0].']');
            // if( (strpos($test4[0],'.')!== false) && (strpos($test4[0],' ')!== false)){
            //     Log::info('A test4-->'.$test4[0]);
            //     $res1 = substr($test4[0],-5);
            //     return $res1;
            // }

            if(strpos($res,'.')!== false){
                Log::info('B test4-->'.$test4[0]);
                $res2 = substr($test4[0],-4);
                return $res2;
            }

            if(strpos($res,' ')!== false){
                Log::info('C test4-->'.$test4[0]);
                $res3 = substr($test4[0],-4);
                return $res3;
            }
            return $res;
        }

        if(count($test5)>1){
            $res = substr($test5[1],-2);
            Log::info('res-->['.$res.']');
            Log::info('test5[0]-->['.$test5[1].']');
            // if( (strpos($test5[1],'.')!== false) && (strpos($test5[1],' ')!== false)){
            //     Log::info('A test5-->'.$test5[1]);
            //     $res1 = substr($test5[1],-5);
            //     return $res1;
            // }
            // if((strpos($test5[0],'นน') === false) && (strpos($test5[1],'นน') === false)){
            //     return false;
            // }

            if(strpos($res,'.')!== false){
                Log::info('B test5-->'.$test5[1]);
                $res2 = substr($test5[1],-4);
                return $res2;
            }

            if(strpos($res,' ')!== false){
                Log::info('C test5-->'.$test5[1]);
                $res3 = substr($test5[1],-4);
                return $res3;
            }
            return $res;
        }

        if(count($test6)>1){
            $res = substr($test6[1],-2);
            Log::info('res-->['.$res.']');
            Log::info('test6[0]-->['.$test6[1].']');
            // if( (strpos($test6[1],'.')!== false) && (strpos($test6[1],' ')!== false)){
            //     Log::info('A test6-->'.$test6[1]);
            //     $res1 = substr($test6[1],-5);
            //     return $res1;
            // }

            if(strpos($res,'.')!== false){
                Log::info('B test6-->'.$test6[1]);
                $res2 = substr($test6[1],-4);
                return $res2;
            }

            if(strpos($res,' ')!== false){
                Log::info('C test6-->'.$test6[1]);
                $res3 = substr($test6[1],-4);
                return $res3;
            }
            return $res;
        }

        
        if(count($test7)>1){
            $res = substr($test7[1],-2);
            Log::info('res-->['.$res.']');
            Log::info('test7[0]-->['.$test7[1].']');
            // if( (strpos($test7[1],'.')!== false) && (strpos($test7[1],' ')!== false)){
            //     Log::info('A test7-->'.$test7[1]);
            //     $res1 = substr($test7[1],-5);
            //     return $res1;
            // }

            if(strpos($res,'.')!== false){
                Log::info('B test7-->'.$test7[1]);
                $res2 = substr($test7[1],-4);
                return $res2;
            }

            if(strpos($res,' ')!== false){
                Log::info('C test7-->'.$test7[1]);
                $res3 = substr($test7[1],-4);
                return $res3;
            }
            return $res;
        }

        return false;
        
        //$pos = stripos($str, $findme);
       
    }
    
  
}
