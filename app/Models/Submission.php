<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use App\Models\User;
use App\Models\GitCommit;

class Submission extends Model
{
    protected $fillable = ['activity_id','user_id','github_link','submitted_at'];

    protected $dates = ['submitted_at'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commits()
    {
        return $this->hasMany(GitCommit::class);
    }
}
