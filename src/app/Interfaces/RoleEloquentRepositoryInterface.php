<?php

namespace App\Interfaces;

interface RoleEloquentRepositoryInterface
{
    public function getAllRole(array $conditions);
    public function findByName($name);
}