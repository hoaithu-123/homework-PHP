<?php

namespace App\Repositories;

use App\Grade;
use Illuminate\Database\Eloquent\Model;

class GradeRepository extends BaseRepository
{
    protected $grade;

    /**
     * Create a new model instance.
     *
     * @param Model $model
     */
    public function __construct(Grade $grade)
    {
        parent::__construct(new Grade());
        $this->grade = $grade;
    }

}
