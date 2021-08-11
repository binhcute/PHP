<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    // protected $table = 'users';
    // //Khóa chính tự động tăng int
    // protected $primaryKey = 'id';

    // //Kết nối CSDL
    // protected $connection = 'mysql';

    // protected $fillable = [
    //     'firstName',
    //     'lastName',
    //     'username',
    //     'avatar',
    //     'gender',
    //     'phone',
    //     'address',
    //     'email',
    //     'password',
    //     'level',
    //     'status'
    // ];


    // public function product(){
    //     return $this->HasMany('App\Models\Product','user_id','id');
    // }
    // public function category(){
    //     return $this->HasMany('App\Models\Category','user_id','id');
    // }    
    // public function porfolio(){
    //     return $this->HasMany('App\Models\Portfolio','user_id','id');
    // }
    // public function article(){
    //     return $this->HasMany('App\Models\Article','user_id','id');
    // }
    // public function order(){
    //     return $this->HasMany('App\Models\Order','user_id','id');
    // }
}
