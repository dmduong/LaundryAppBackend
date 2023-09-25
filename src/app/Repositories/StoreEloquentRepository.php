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

    public function searchStore($conditions)
    {
        return $this->model
            ->when(
                !is_null($conditions['db_store_number']),
                function ($query) use ($conditions) {
                    $query->where('db_store_number', 'LIKE', '%' . $conditions['db_store_number'] . '%');
                }
            )
            ->when(
                !is_null($conditions['db_store_name']),
                function ($query) use ($conditions) {
                    $query->where('db_store_name', 'LIKE', '%' . $conditions['db_store_name'] . '%');
                }
            )
            ->when(
                !is_null($conditions['db_store_phone']),
                function ($query) use ($conditions) {
                    $query->where('db_store_phone', 'LIKE', '%' . $conditions['db_store_phone'] . '%');
                }
            )
            ->when(
                !is_null($conditions['db_store_address']),
                function ($query) use ($conditions) {
                    $query->where('db_store_address', 'LIKE', '%' . $conditions['db_store_address'] . '%');
                }
            )
            ->get();
    }
}