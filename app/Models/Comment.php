<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'tpl_comment';

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'article_id',
        'rate',
        'role',
        'comment_description',
        'status',
        'created_at',
        'updated_at'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','product_id');
    }
    public function article(){
        return $this->belongsTo('App\Models\Article','article_id','article_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
