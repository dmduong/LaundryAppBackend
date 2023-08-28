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
        return $this->storeEloquentRepository->storeDatas($data);
    }

    public function getAllStore()
    {
        return $this->storeEloquentRepository->getDataAlls();
    }
}