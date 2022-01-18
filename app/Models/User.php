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
        $findme1   = 'kg';
        $findme2   = 'Kg';
        $test1 = explode($findme1,$str);
        $test2 = explode($findme2,$str);

        if(count($test1)>1){
            $res = substr($test1[0],-2);
            if(strpos($res,'.') !== false){
                $res2 = substr($test1[0],-4);
               
                return $res2;
            }
            return $res;
        }

        if(count($test2)>1){
            $res = substr($test2[0],-2);
            if(strpos($res,'.')!== false){
                $res2 = substr($test2[0],-4);
                return $res2;
            }
            return $res;
        }

        return false;
        
        //$pos = stripos($str, $findme);
       
    }
}
