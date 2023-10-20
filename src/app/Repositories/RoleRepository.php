<?php
namespace App\Repositories;

use App\Interfaces\RoleEloquentRepositoryInterface;
use App\Repositories\EloquentRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends EloquentRepository implements RoleEloquentRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Role::class;
    }

    public function getAllRole(array $conditions)
    {
        return $this->model->when(!empty($conditions['name']), function ($query) use ($conditions) {
            $query->where('name', 'LIKE', '%' . $conditions['name'] . '%');
        });
    }
}