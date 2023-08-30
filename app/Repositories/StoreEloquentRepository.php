<?php
namespace App\Repositories;

use App\Interfaces\StoreEloquentRepositoryInterface;
use App\Models\StoreModel;
use App\Repositories\EloquentRepository;

class StoreEloquentRepository extends EloquentRepository implements StoreEloquentRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return StoreModel::class;
    }

    public function show(int $id)
    {
        return $this->find($id); 
    }
}