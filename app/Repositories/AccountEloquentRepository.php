<?php
namespace App\Repositories;

use App\Enums\StatusAccountEnums;
use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Models\AccountModel;
use App\Repositories\EloquentRepository;

class AccountEloquentRepository extends EloquentRepository implements AccountEloquentRepositoryInterFace
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return AccountModel::class;
    }

    public function storeAccount(array $data)
    {
        return $this->create($data);
    }

    public function checkUserLogin(array $data)
    {
        return $this->model
            ->where('db_account_name', $data['db_account_name'])
            ->where('db_account_status', StatusAccountEnums::Active)
            ->first();
    }
}