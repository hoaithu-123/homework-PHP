<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'name',
        'homeroom_teacher',
        'grade_id',
    ];
    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function students(){
        return $this->hasMany(Student::class, 'class_id');
    }

    public function homeroom(){
        return $this->belongsTo(Teacher::class, 'homeroom_teacher');
    }

    public function countStudents(){
        return $this->students;
    }
}
