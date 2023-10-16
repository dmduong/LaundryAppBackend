<?php
namespace App\Repositories;

use App\Interfaces\TestEloquentRepositoryInterface;
use App\Models\EmployeeModel;
use App\Repositories\EloquentRepository;

class TestRepository extends EloquentRepository implements TestEloquentRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return EmployeeModel::class;
    }
}