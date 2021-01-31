<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','slug','content','user_id'];
    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'category_post', 'category_id', 'post_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
    public function scopeUnPublish($query)
    {
        return $query->where('published', false);
    }



}
