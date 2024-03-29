<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function programme()
    {
        return $this->belongsTo('App\Programme');
    }
    public function studentcourses()
    {
        return $this->hasMany('App\StudentCourse');
    }
}
