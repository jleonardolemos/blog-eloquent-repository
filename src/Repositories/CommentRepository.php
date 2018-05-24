<?php

namespace Llemos\BlogEloquentRepository\Repositories;

use Llemos\Blog\Contracts\Repositories\CommentRepository as CommentRepositoryContract;
use Llemos\BlogEloquentRepository\Model\Comment;
use Llemos\Blog\Entities\Comment as CommentEntity;
use Llemos\Blog\Contracts\Entities\Entity;
use Illuminate\Support\Collection;

class CommentRepository extends AbstractRepository implements CommentRepositoryContract
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return collect($this->model->all()->map(function ($comment) {
            $entity = new CommentEntity($comment->toArray());
            return $entity;
        }));
    }

    public function findByUserId(int $userId) : Collection
    {
        return collect($this->model->whereUserId($userId)->get()->map(function ($comment) {
            $entity = new CommentEntity($comment->toArray());
            return $entity;
        }));
    }

    public function find(string $id) : Entity
    {
        return new CommentEntity($this->model->findOrFail($id)->toArray());
    }

    public function findBy(string $field, $value) : Entity
    {
        return new CommentEntity(
            $this->model->where($field, $value)->firstOrFail()->toArray()
        );
    }
}
