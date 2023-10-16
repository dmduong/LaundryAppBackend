<?php

namespace App\Interfaces;

interface RoleEloquentRepositoryInterface
{
    public function getAllRole(array $conditions);
}