<?php

namespace Llemos\BlogEloquentRepository\Repositories;

use Llemos\Blog\Contracts\Repositories\PostRepository as PostRepositoryContract;
use Llemos\BlogEloquentRepository\Model\Post;

class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    protected $modelString = Post::class;

    public function all()
    {
        return collect($this->model->with('comments')->get()->toArray());
    }
}
