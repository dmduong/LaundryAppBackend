<?php
namespace App\Services;

use App\Enums\EmployeeStatusEnum;
use App\Exceptions\ErrorsException;
use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Interfaces\EmployeeEloquentRepositoryInterface;
use App\Traits\Paginations;
use App\Traits\UniqueCodeTrait;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{
    use UniqueCodeTrait, Paginations;
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
        $employee = $this->employeeEloquentRepository->create([
            'db_store_id' => $storeId,
            'db_employee_number' => $this->codeNumber(),
            'db_employee_name' => $requestBody['db_employee_name'],
            'db_employee_gender' => $requestBody['db_employee_gender'],
            'db_employee_email' => $requestBody['db_employee_email'],
            'db_employee_address' => $requestBody['db_employee_address'],
            'db_employee_birthday' => $requestBody['db_employee_birthday'],
            'db_employee_phone' => $requestBody['db_employee_phone'],
            'db_employee_status' => EmployeeStatusEnum::Active,
        ]);

        if (!is_null($employee)) {
            $employee->account()->create([
                'db_employee_id' => $employee->id,
                'db_account_name' => $requestBody['db_account_name'],
                'db_account_password' => Hash::make($requestBody['db_account_password'])
            ]);
        }

        return $employee;
    }

    public function getInforEmployee($employeeId)
    {
        $employee = $this->employeeEloquentRepository->find($employeeId);

        if (is_null($employee)) {
            throw new ErrorsException('The employee not found');
        }

        return $employee;
    }

    public function searchEmployee($requestBody, $storeId)
    {
        return $this->paginations(
            $this->employeeEloquentRepository->searchEmployee($requestBody, $storeId),
            $requestBody
        );
    }
}