<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subject_code',
        'description'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function classes()
    {
        return $this->belongsToMany(Grade::class);
    }

}
