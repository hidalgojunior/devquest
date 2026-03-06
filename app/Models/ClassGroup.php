<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Activity;
use App\Models\Content;

class ClassGroup extends Model
{
    protected $fillable = ['name','course','component','qr_open'];

    protected $casts = ['qr_open' => 'boolean'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
