<?php

namespace Llemos\BlogEloquentRepository\Repositories;

use Llemos\Blog\Contracts\Repositories\PostRepository as PostRepositoryContract;
use Llemos\BlogEloquentRepository\Model\Post;
use Llemos\Blog\Entities\Post as PostEntity;
use Llemos\Blog\Contracts\Entities\Entity;
use Illuminate\Support\Collection;

class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return collect($this->model->all()->map(function ($post) {
            $entity = new PostEntity($post->toArray());
            return $entity;
        }));
    }

    public function allWithComments(): Collection
    {
        return collect($this->model->with('comments')->get()->map(function ($post) {
            $entity = new PostEntity($post->toArray());
            return $entity;
        }));
    }

    public function findByUserId(int $userId) : Collection
    {
        return collect($this->model->whereUserId($userId)->get()->map(function ($post) {
            $entity = new PostEntity($post->toArray());
            return $entity;
        }));
    }

    public function find(string $id): Entity
    {
        return new PostEntity($this->model->findOrFail($id)->toArray());
    }

    public function findBy(string $field, $value): Entity
    {
        return new PostEntity(
            $this->model->where($field, $value)->firstOrFail()->toArray()
        );
    }
}
