<?php
namespace App\Repositories;

use App\Interfaces\PermissionEloquentRepositoryInterface;
use App\Repositories\EloquentRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends EloquentRepository implements PermissionEloquentRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Permission::class;
    }
}