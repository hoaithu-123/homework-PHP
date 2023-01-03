<?php

namespace App\Repositories;

use App\Student;
use Illuminate\Database\Eloquent\Model;

class StudentRepository extends BaseRepository
{
    protected $student;

    /**
     * Create a new model instance.
     *
     * @param Model $model
     */
    public function __construct(Student $student)
    {
        parent::__construct(new Student());
        $this->student = $student;
    }

}
