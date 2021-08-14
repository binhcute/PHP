<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

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
        'updated_at',
        'deleted_at'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','product_id')->withTrashed();
    }
    public function article(){
        return $this->belongsTo('App\Models\Article','article_id','article_id')->withTrashed();
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
