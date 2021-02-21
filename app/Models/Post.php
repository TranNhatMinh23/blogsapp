<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','slug','published','content', 'view', 'timePost', 'point', 'user_id'];
    protected $dates = ['created_at', 'deleted_at'];
    
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
    public function getPublishedAttribute(){
        Carbon::setLocale('vi');
        // {{$post->created_at->diffForHumans()}}
        $time =  $this->attributes['created_at'];
        return Carbon::parse($time)->diffForHumans();

    }




}
