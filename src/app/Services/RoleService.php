<?php
namespace App\Services;

use App\Exceptions\ErrorsException;
use App\Interfaces\RoleEloquentRepositoryInterface;
use App\Traits\Paginations;
use App\Traits\UniqueCodeTrait;

class RoleService
{
    use UniqueCodeTrait, Paginations;
    protected RoleEloquentRepositoryInterface $roleEloquentRepository;

    public function __construct(
        RoleEloquentRepositoryInterface $roleEloquentRepository
    ) {
        $this->roleEloquentRepository = $roleEloquentRepository;
    }

    public function getAllRole($conditions)
    {
        return $this->paginations($this->roleEloquentRepository->getAllRole($conditions), $conditions);
    }

    public function find(int $roleId)
    {
        $result = $this->roleEloquentRepository->find($roleId);

        if (is_null($result)) {
            throw new ErrorsException("The role not found !");
        }

        return $result;
    }

    public function assignPermission(array $conditions, int $roleId)
    {
        $result = $this->find($roleId);
        return $result->syncPermissions($conditions['permission_id']);
    }

    public function update($data, $roleId)
    {
        $this->find($roleId);
        return $this->roleEloquentRepository->update($roleId, $data);
    }

    public function destroy($roleId)
    {
        $this->find($roleId);
        return $this->roleEloquentRepository->delete($roleId);
    }
}