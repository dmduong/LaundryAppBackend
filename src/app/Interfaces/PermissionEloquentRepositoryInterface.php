<?php

namespace App\Interfaces;

interface PermissionEloquentRepositoryInterface
{
    public function getAllPermission(array $conditions);
}