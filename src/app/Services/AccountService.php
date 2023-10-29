<?php
namespace App\Services;

use App\Enums\ActiveAccountEnum;
use App\Enums\EmployeeStatusEnum;
use App\Enums\StatusAccountEnums;
use App\Enums\StatusStoresEnums;
use App\Exceptions\ErrorsException;
use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Interfaces\EmployeeEloquentRepositoryInterface;
use App\Interfaces\StoreEloquentRepositoryInterface;
use App\Mail\SendEmail;
use App\Traits\UniqueCodeTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AccountService
{
    use UniqueCodeTrait;
    protected StoreEloquentRepositoryInterface $storeEloquentRepository;
    protected AccountEloquentRepositoryInterFace $accountEloquentRepository;
    protected EmployeeEloquentRepositoryInterface $employeeEloquentRepository;

    public function __construct(
        StoreEloquentRepositoryInterface $storeEloquentRepository,
        EmployeeEloquentRepositoryInterface $employeeEloquentRepository,
        AccountEloquentRepositoryInterFace $accountEloquentRepository,
    ) {
        $this->storeEloquentRepository = $storeEloquentRepository;
        $this->accountEloquentRepository = $accountEloquentRepository;
        $this->employeeEloquentRepository = $employeeEloquentRepository;
    }

    public function create($conditions)
    {
        DB::beginTransaction();

        try {
            $code = $this->codeActiveAccount();
            $store = $this->storeEloquentRepository->create([
                'db_store_number' => $this->codeNumber(),
                'db_store_name' => $conditions['db_store_name'],
                'db_store_address' => $conditions['db_store_address'],
                'db_store_status' => StatusStoresEnums::Block,
            ]);

            if (!is_null($store)) {
                $employee = $this->employeeEloquentRepository->create([
                    'db_store_id' => $store->id,
                    'db_employee_number' => $this->codeNumber(),
                    'db_employee_name' => $conditions['db_employee_name'],
                    'db_employee_phone' => $conditions['db_employee_phone'],
                    'db_employee_email' => $conditions['db_employee_email'],
                    'db_employee_gender' => $conditions['db_employee_gender'],
                    'db_employee_birthday' => $conditions['db_employee_birthday'],
                    'db_employee_status' => EmployeeStatusEnum::Block,
                ]);

                $account = $employee->account()->create([
                    'db_employee_id' => $employee->id,
                    'db_account_name' => $conditions['db_account_name'],
                    'db_account_password' => Hash::make($conditions['db_account_password']),
                    'db_account_code' => $code,
                    'db_account_status' => StatusAccountEnums::Block,
                ]);
            }

            DB::commit();

            Mail::to($conditions['db_employee_email'])->send(
                new SendEmail(
                    $code,
                    $conditions['db_store_name'],
                    $conditions['db_employee_name'],
                    $conditions['db_account_name']
                )
            );
            return [
                'db_account_id' => $account->id,
                'db_employee_id' => $account->db_employee_id,
                'db_employee_email' => $employee->db_employee_email,
            ];

        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function login($requestBody)
    {
        $checkLogin = $this->accountEloquentRepository->checkUserLogin($requestBody);

        if (is_null($checkLogin)) {
            throw new ErrorsException("The account is incorrect !", 400);
        }

        $checkPass = Hash::check($requestBody['db_account_password'], $checkLogin->db_account_password);
        if (!$checkPass) {
            throw new ErrorsException("The password is incorrect !", 400);
        }

        if ($checkLogin->db_account_status === StatusAccountEnums::Block) {
            throw new ErrorsException('The account is blocked', 400);
        }

        $token = $this->createNewToken($checkLogin);

        $refreshToken = $this->refreshToken($checkLogin);

        $checkLogin->update([
            'db_account_token' => $token,
            'db_account_refresh_token' => $refreshToken,
        ]);

        return $checkLogin->refresh();
    }

    protected function createNewToken($user)
    {
        return JWTAuth::fromUser($user);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function refreshToken($user)
    {
        return $this->createNewToken($user);
    }

    public function logout($accountId)
    {
        $account = $this->accountEloquentRepository->find($accountId);

        if (is_null($account)) {
            throw new ErrorsException("The account not found", 400);
        }

        return $account->update([
            'db_account_token' => null,
            'db_account_refresh_token' => null
        ]);
    }

    public function verify($conditions)
    {
        DB::transaction(function () use ($conditions) {
            $account = $this->accountEloquentRepository->find($conditions['db_account_id']);

            if (is_null($account->db_account_code)) {
                throw new ErrorsException('Mã xác thực hết hiệu lực.', 400);
            }

            if ($account->db_account_code != $conditions['code']) {
                throw new ErrorsException('Mã xác thực không chính xác.', 400);
            }

            $account->update([
                'db_account_active' => ActiveAccountEnum::Active,
                'db_account_status' => StatusAccountEnums::Active,
            ]);

            $account->employee()->update([
                'db_employee_status' => EmployeeStatusEnum::Active,
            ]);

            $account->employee->store()->update([
                'db_store_status' => StatusStoresEnums::Active,
            ]);
        });
    }
}