<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'name',
        'note',
    ];

    public function students()
    {
        return $this->hasMany(Student::class,'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function classes(){
        return $this->hasMany(Classes::class);
    }

    public function countClasses(){
        //có thể tính toán relationship trong hàm model
        //VD: 1 khối 7 - có nhiều lớp ($this->classes)- các lớp thuộc khối 7 đó
        //
        return count($this->classes);
    }
}
