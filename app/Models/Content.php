<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassGroup;

class Content extends Model
{
    protected $fillable = ['class_group_id','date','description'];

    protected $dates = ['date'];

    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class);
    }
}
