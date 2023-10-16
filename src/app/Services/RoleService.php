<?php
namespace App\Services;

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
}