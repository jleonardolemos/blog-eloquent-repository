<?php

namespace Llemos\BlogEloquentRepository\Repositories;

use Llemos\Blog\Contracts\Repositories\Repository as RepositoryContract;
use Llemos\Blog\Contracts\Entities\Entity;

class AbstractRepository implements RepositoryContract
{
    protected $model;

    //TODO try to solve repository interface return type
    //maibe this class can not has a all() method implementation, just the repo interface
    //This can be a job for the children, but the method must be in the parent interface
    public function all()
    {
        return collect($this->model->all()->toArray());
    }

    public function add(Entity $entity)
    {
        $this->model->create($entity->toArray());
    }

    public function update(Entity $entity)
    {
        $this->model
            ->findOrFail($entity->getId())
            ->update($entity->toArray());
    }

    public function remove($id)
    {
        $this->model->findOrFail($id)->delete();
    }

    public function find(string $id): Entity
    {
        throw new Exception('Unimplemented method');
    }

    public function findBy(string $field, $value): Entity
    {
        throw new Exception('Unimplemented method');
    }
}
