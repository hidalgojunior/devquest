<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Submission;

class GitCommit extends Model
{
    protected $fillable = ['submission_id','commit_hash','message','committed_at','url'];

    protected $dates = ['committed_at'];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
