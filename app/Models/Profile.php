<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = ['avarta', 'fbsocial', 'linkedInSocial', 'phoneNumber' ,'birthday', 'user_id'];

    public function users() {
        return $this->belongsTo('App\User');
    }
}
