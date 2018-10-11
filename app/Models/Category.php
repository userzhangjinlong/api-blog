<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pid', 'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pid'
    ];

    /**
     * 关联文章一堆多
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasManyArticles(){
        return $this->hasMany(Article::class, 'cat_id', 'id');
    }
}
