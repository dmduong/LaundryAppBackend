<?php
namespace App\Services\Post;

use App\Repositories\Post\PostEloquentRepository;

class PostService
{
    protected PostEloquentRepository $repository;
    public function __construct(PostEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPost()
    {
        return $this->repository->getAll();
    }

    public function store($data)
    {
        return $this->repository->create($data);
    }
}