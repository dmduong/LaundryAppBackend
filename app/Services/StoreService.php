<?php
namespace App\Services;

use App\Repositories\StoreEloquentRepository;

class StoreService
{
    protected StoreEloquentRepository $storeEloquentRepository;
    public function __construct(StoreEloquentRepository $storeEloquentRepository)
    {
        $this->storeEloquentRepository = $storeEloquentRepository;
    }

    public function createStore($data)
    {
        return $this->storeEloquentRepository->create($data);
    }
}