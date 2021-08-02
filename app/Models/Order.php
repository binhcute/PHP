<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tpl_order';

    protected $primaryKey = 'order_id';
    
    protected $connection = 'mysql';
    
    protected $fillable = [
        'user_id',
        'status',
        'note',
        'created_at',
        'updated_at'
    ];

    public function orderDetail(){
        return $this->HasMany('App\Models\OrderDetail','order_id','order_id');
    }
}
