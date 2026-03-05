<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Presence extends Model
{
    protected $fillable = ['user_id','date','present','qr_token','qr_expires_at'];

    protected $dates = ['date','qr_expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
