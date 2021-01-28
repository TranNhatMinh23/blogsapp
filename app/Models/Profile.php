<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = ['avarta', 'cover', 'birthday', 'user_id'];

    public function users() {
        return $this->belongsTo('App\User');
    }
}
