<?php
namespace App\Services;

use App\Enums\StatusAccountEnums;
use App\Exceptions\ErrorsException;
use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Interfaces\StoreEloquentRepositoryInterface;
use App\Traits\UniqueCodeTrait;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AccountService
{
    use UniqueCodeTrait;
    protected StoreEloquentRepositoryInterface $storeEloquentRepository;
    protected AccountEloquentRepositoryInterFace $accountEloquentRepository;

    public function __construct(
        StoreEloquentRepositoryInterface $storeEloquentRepository,
        AccountEloquentRepositoryInterFace $accountEloquentRepository,
    ) {
        $this->storeEloquentRepository = $storeEloquentRepository;
        $this->accountEloquentRepository = $accountEloquentRepository;
    }

    public function login($requestBody)
    {
        $checkLogin = $this->accountEloquentRepository->checkUserLogin($requestBody);

        if (is_null($checkLogin)) {
            throw new ErrorsException("The account is incorrect !", 'account_is_incorrect');
        }

        $checkPass = Hash::check($requestBody['db_account_password'], $checkLogin->db_account_password);
        if (!$checkPass) {
            throw new ErrorsException("The password is incorrect !", 'password_is_incorrect');
        }

        if ($checkLogin->db_account_status === StatusAccountEnums::Block) {
            throw new ErrorsException('The account is blocked', 'account_blocked');
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
            throw new ErrorsException("The account not found", "account_not_found");
        }

        return $account->update([
            'db_account_token' => null,
            'db_account_refresh_token' => null
        ]);
    }
}