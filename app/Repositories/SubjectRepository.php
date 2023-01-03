<?php

namespace App\Repositories;

use App\Student;
use App\Subject;
use Illuminate\Database\Eloquent\Model;

class SubjectRepository extends BaseRepository
{
    protected $subject;

    /**
     * Create a new model instance.
     *
     * @param Model $model
     */
    public function __construct(Subject $subject)
    {
        parent::__construct(new Subject());
        $this->subject = $subject;
    }

}
