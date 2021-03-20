<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','slug'];

    public function post()
    {
        return $this->belongsToMany('App\Models\Post', 'category_post', 'category_id', 'post_id');
    }
}
