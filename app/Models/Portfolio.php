<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'tpl_portfolio';
    
    protected $primaryKey = 'port_id';
    
    protected $connection = 'mysql';
    
    protected $fillable = [
        'user_id',
        'port_name',
        'port_avatar',
        'port_img',
        'port_origin',
        'port_description',
        'status',
        'created_at',
        'updated_at',
    ];

    public function Product(){
        
        return $this->HasMany('App\Models\Product','port_id','port_id');
    }
    public function User(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
