<?php

namespace Llemos\BlogEloquentRepository\Repositories;

use Llemos\Blog\Contracts\Repositories\UserRepository as UserRepositoryContract;
use Llemos\BlogEloquentRepository\Model\User;
use Llemos\Blog\Entities\User as UserEntity;
use Llemos\Blog\Contracts\Entities\Entity;

class UserRepository extends AbstractRepository implements UserRepositoryContract
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return collect($this->model->all()->map(function ($user) {
            $entity = new UserEntity($user->toArray());
            return $entity;
        }));
    }

    public function find(string $id): Entity
    {
        return new UserEntity($this->model->findOrFail($id)->toArray());
    }

    public function findBy(string $field, $value): Entity
    {
        return new UserEntity(
            $this->model->where($field, $value)->firstOrFail()->toArray()
        );
    }
}
