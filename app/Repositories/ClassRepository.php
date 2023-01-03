<?php

namespace App\Repositories;

use App\Classes;
use Illuminate\Database\Eloquent\Model;

class ClassRepository extends BaseRepository
{
    protected $class;

    /**
     * Create a new model instance.
     *
     * @param Model $model
     */
    public function __construct(Classes $class)
    {
        parent::__construct(new Classes());
        $this->class = $class;
    }

}
