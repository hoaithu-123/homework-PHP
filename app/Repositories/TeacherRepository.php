<?php

namespace App\Repositories;

use App\Student;
use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class TeacherRepository extends BaseRepository
{
    protected $teacher;

    /**
     * Create a new model instance.
     *
     * @param Model $model
     */
    public function __construct(Teacher $teacher)
    {
        parent::__construct(new Teacher());
        $this->teacher = $teacher;
    }

}
