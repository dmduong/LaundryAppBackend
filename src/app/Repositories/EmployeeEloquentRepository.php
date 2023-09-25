<?php
namespace App\Repositories;

use App\Interfaces\EmployeeEloquentRepositoryInterface;
use App\Models\EmployeeModel;
use App\Repositories\EloquentRepository;

class EmployeeEloquentRepository extends EloquentRepository implements EmployeeEloquentRepositoryInterface
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