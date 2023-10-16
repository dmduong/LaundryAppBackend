<?php
namespace App\Services;

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
}