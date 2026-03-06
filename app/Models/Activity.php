<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassGroup;
use App\Models\Submission;

class Activity extends Model
{
    protected $fillable = ['class_group_id','title','description','start_date','due_date','is_bonus','closed','is_draft','visible_from','open_to_all'];

    protected $dates = ['start_date','due_date','visible_from'];

    protected $casts = [
        'is_bonus' => 'boolean',
        'closed' => 'boolean',
        'is_draft' => 'boolean',
        'open_to_all' => 'boolean',
    ];

    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
