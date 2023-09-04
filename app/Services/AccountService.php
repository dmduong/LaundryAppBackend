<?php
namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
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
            throw new ResourceNotFoundException("The account is incorrect !", 'account_is_incorrect');
        }

        $checkPass = Hash::check($requestBody['db_account_password'], $checkLogin->db_account_password);
        if (!$checkPass) {
            throw new ResourceNotFoundException("The password is incorrect !", 'password_is_incorrect');
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
}