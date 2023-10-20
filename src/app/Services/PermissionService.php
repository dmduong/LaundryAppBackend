<?php
namespace App\Services;

use App\Exceptions\ErrorsException;
use App\Interfaces\PermissionEloquentRepositoryInterface;
use App\Traits\Paginations;
use App\Traits\UniqueCodeTrait;

class PermissionService
{
    use UniqueCodeTrait, Paginations;
    protected PermissionEloquentRepositoryInterface $permissionEloquentRepository;

    public function __construct(
        PermissionEloquentRepositoryInterface $permissionEloquentRepository,
    ) {
        $this->permissionEloquentRepository = $permissionEloquentRepository;
    }

    public function getAllPermission(array $conditions)
    {
        return $this->paginations($this->permissionEloquentRepository->getAllPermission($conditions), $conditions);
    }

    public function find($permissionId)
    {
        $result = $this->permissionEloquentRepository->find($permissionId);

        if (is_null($result)){
            throw new ErrorsException("The permissions not found.", "permission_not_found");
        }

        return $result;
    }

    public function update($data, $permissionId)
    {
        $this->find($permissionId);
        return $this->permissionEloquentRepository->update($permissionId, $data);
    }

    public function destroy($permissionId)
    {
        $this->find($permissionId);
        return $this->permissionEloquentRepository->delete($permissionId);
    }
}