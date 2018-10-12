<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use Notifiable;

    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'imr_url', 'description', 'content', 'brow_volume', 'thumbs_up', 'cat_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];


    /**
     * 关联分类 一对一 获取此文章下拥有的分类名称
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(){
        return $this->hasOne(Category::class, 'id', 'cat_id')->select('id', 'name');
    }

}
