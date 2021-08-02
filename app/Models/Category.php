<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'tpl_category';

    protected $primaryKey = 'cate_id';

    protected $fillable = [
        'user_id',
        'cate_name',
        'cate_img',
        'cate_description',
        'status',
        'created_at',
        'updated_at',
        'view'
    ];

    // public function Cate(){
    //     return DB::table('tpl_category')->where('status',1)->get();
    // }

    public function Product(){
        return $this->HasMany('App\Models\Product','cate_id','cate_id');
    }
    public function User(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
