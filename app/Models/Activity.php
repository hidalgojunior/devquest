<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassGroup;
use App\Models\Submission;

class Activity extends Model
{
    protected $fillable = ['class_group_id','title','description','start_date','due_date','is_bonus','closed'];

    protected $dates = ['start_date','due_date'];

    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
