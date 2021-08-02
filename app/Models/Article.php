<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'tpl_article';
    //Khóa chính tự động tăng int
    protected $primaryKey = 'article_id';

    //Kết nối CSDL
    protected $connection = 'mysql';
    
    protected $fillable = [
        'user_id',
        'article_name',
        'article_img',
        'article_description',
        'article_keyword',
        'status',
        'created_at',
        'updated_at',
        'view'
    ];

    public function User(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
