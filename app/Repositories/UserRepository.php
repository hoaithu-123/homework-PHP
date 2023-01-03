<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    protected $user;

    /**
     * Create a new model instance.
     *
     * @param Model $model
     */
    public function __construct(User $user)
    {
        parent::__construct(new User());
        $this->user = $user;
    }

}
