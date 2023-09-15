<?php
namespace App\Services;

use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Interfaces\EmployeeEloquentRepositoryInterface;
use App\Traits\UniqueCodeTrait;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    use UniqueCodeTrait;
    protected EmployeeEloquentRepositoryInterface $employeeEloquentRepository;

    protected AccountEloquentRepositoryInterFace $accountEloquentRepository;

    public function __construct(
        EmployeeEloquentRepositoryInterface $employeeEloquentRepository,
        AccountEloquentRepositoryInterFace $accountEloquentRepository
    ) {
        $this->employeeEloquentRepository = $employeeEloquentRepository;
        $this->accountEloquentRepository = $accountEloquentRepository;
    }

    public function createEmployee($requestBody, $storeId)
    {
        $accountEmployee = $requestBody['db_account_name'];
        $passwordEmployee = $requestBody['db_account_password'];

        unset(
            $requestBody['db_account_name'], 
            $requestBody['db_account_password'],
            $requestBody['db_employee_number'],
        );

        $number = $this->generateUniqueCode('employees', 'db_employee_number', 'db_employee_created_at');

        $employee = $this->employeeEloquentRepository->create(
            array_merge(
                [
                    'db_employee_number' => $number,
                    'db_store_id' => $storeId,
                    'db_employee_created_at' => now()->timestamp,
                    'db_employee_updated_at' => now()->timestamp,
                ],
                 $requestBody
                )
        );

        if (!is_null($employee)) {
            $this->accountEloquentRepository->create([
                'db_employee_id' => $employee->id,
                'db_account_name' => $accountEmployee,
                'db_account_password' => Hash::make($passwordEmployee),
                'db_account_created_at' => now()->timestamp,
                'db_account_updated_at' => now()->timestamp,
            ]);
        }

        return $employee;
    }
}