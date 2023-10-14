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

    public function searchEmployee($requestBody, $storeId)
    {
        return $this->model
            ->where('db_store_id', $storeId)
            ->when(!empty($requestBody['db_employee_name']), function ($query) use ($requestBody) {
                $query->where('db_employee_name', 'LIKE', '%' . $requestBody['db_employee_name'] . '%');
            });
    }
}