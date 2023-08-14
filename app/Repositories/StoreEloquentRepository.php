<?php
namespace App\Repositories;

use App\Models\StoreModel;
use App\Repositories\EloquentRepository;

class StoreEloquentRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return StoreModel::class;
    }
}