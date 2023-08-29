<?php
namespace App\Services;

use App\Interfaces\StoreEloquentRepositoryInterface;

class StoreService
{
    protected StoreEloquentRepositoryInterface $storeEloquentRepository;
    
    public function __construct(StoreEloquentRepositoryInterface $storeEloquentRepository)
    {
        $this->storeEloquentRepository = $storeEloquentRepository;
    }

    public function createStore($data)
    {
        return $this->storeEloquentRepository->create($data);
    }

    public function getAll()
    {
        return $this->storeEloquentRepository->getAll();
    }
}