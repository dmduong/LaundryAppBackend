<?php

namespace App\Interfaces;

interface EmployeeEloquentRepositoryInterface
{
    public function searchEmployee($requestBody, $storeId);
}