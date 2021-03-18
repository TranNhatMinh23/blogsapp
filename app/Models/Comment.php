<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['content','post_id','user_id'];
    protected $dates = ['created_at', 'deleted_at'];

    public function posts()
    {
        return $this->belongsTo('App\Models\Post','post_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getCreatedatAttribute($time){
        Carbon::setLocale('vi');
        // {{$post->created_at->diffForHumans()}}
        return Carbon::parse($time);
    }
}
