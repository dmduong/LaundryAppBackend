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

    public function getDataAlls()
    {
        return $this->model->query()->get();
    }

    public function storeDatas($data)
    {
        return $this->model->query()->create($data);
    }
}