<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['content','post_id','user_id'];


    public function posts()
    {
        return $this->belongsTo('App\Models\Post','post_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
