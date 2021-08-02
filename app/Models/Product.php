<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tpl_product';

    protected $primaryKey = 'product_id';

    protected $connection = 'mysql';
    
    
    protected $fillable =[
        'cate_id',
        'user_id',
        'port_id',
        'product_name',
        'product_img',
        'product_img_hover',
        'product_price',
        'product_color',
        'product_description',
        'product_quantity',
        'product_keyword',
        'status',
        'created_at',
        'updated_at',
        'view'
    ];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'cate_id', 'cate_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
    public function portfolio(){
        return $this->belongsTo('App\Models\Portfolio', 'port_id','port_id');
    }
    public function orderDetail(){
        return $this->HasMany('App\Models\OrderDetail','product_id','product_id');
    }
}
