<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    /**
     * Create a new model instance.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param array|integer $id
     * @param array $columns
     * @param array $relations
     *
     * @return Model|null
     */
    public function find($id, $columns = ['*'], array $relations = [])
    {
        $query = $this->model::query();

        if ($relations) {
            $query = $query->with($relations);
        }

        return $query->find($id, $columns);
    }

    /**
     * Finds a single entity by a set of condition.
     *
     * @param array $conditions
     * @param array|null $orderBy
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function findOneBy(array $conditions, array $orderBy = null)
    {
        $query = $this->model::query();

        if ($orderBy) {
            foreach ($orderBy as $column => $direction) {
                $query = $query->orderBy($column, $direction);
            }
        }

        return $query->firstWhere($conditions);
    }

    /**
     * Finds an entity by its primary key / identifier or throw an exception.
     *
     * @param array|integer $id
     * @param array $columns
     * @param array $relations
     *
     * @return Model|null
     */
    public function findOrFail($id, $columns = ['*'], array $relations = [])
    {
        $query = $this->model::query();

        if ($relations) {
            $query = $query->with($relations);
        }

        return $query->findOrFail($id, $columns);
    }

    /**
     * Finds all entities in the repository.
     *
     * @param array $columns
     *
     * @return Collection
     */
    public function findAll($columns = ['*'])
    {
        return $this->model::query()->get($columns);
    }

    /**
     * Finds entities by a set of criteria.
     *
     * @param array $conditions
     * @param array|string|null $relation
     * @param array|null $orderBy
     * @return Builder[]|Collection
     */
    public function findBy(array $conditions, array $orderBy = null, $relation = null)
    {
        $query = $this->model::query();

        if ($relation) {
            $query = $query->with($relation);
        }

        if ($orderBy) {
            foreach ($orderBy as $column => $direction) {
                $query = $query->orderBy($column, $direction);
            }
        }

        return $query->where($conditions)->get();
    }

    /**
     * Add an "order by" clause for a timestamp to the query.
     *
     * @param  string|\Illuminate\Database\Query\Expression  $column
     * @return Model|object
     */
    public function getLatestAll($column = null)
    {
        return $this->model::query()->latest()->get();
    }
}
