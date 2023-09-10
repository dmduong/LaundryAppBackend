<?php
namespace App\Services;

use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Interfaces\StoreEloquentRepositoryInterface;
use App\Traits\UniqueCodeTrait;
use App\Exceptions\ResourceNotFoundException;
use Illuminate\Support\Facades\Hash;

class StoreService
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

    public function createStore($data)
    {
        $dataStore = array_merge([
            'db_store_name' => $data['db_store_name'],
            'db_store_phone' => $data['db_store_phone'],
            'db_store_email' => $data['db_store_email'],
            'db_store_address' => $data['db_store_address'],
        ], [
            'db_store_number' => $this->generateUniqueCode(
                'stores',
                'db_store_number',
                'db_store_created_at'
            ),
            'db_store_created_at' => now()->timestamp,
            'db_store_updated_at' => now()->timestamp,
        ]);

        $result = $this->storeEloquentRepository->create($dataStore);

        if ($result->exists) {
            $dataAccount = [
                'db_store_id' => $result->id,
                'db_account_name' => $result->db_store_phone,
                'db_account_password' => Hash::make($data['db_account_password']),
                'db_account_created_at' => now()->timestamp,
                'db_account_updated_at' => now()->timestamp,
            ];

            return $this->accountEloquentRepository->storeAccount($dataAccount);
        }
    }

    public function searchStore($conditions)
    {
        return $this->storeEloquentRepository->searchStore($conditions);
    }

    public function show($id)
    {
        $result = $this->storeEloquentRepository->show($id);

        if (is_null($result)) {
            throw new ResourceNotFoundException(
                "The store not found.",
                'store_not_found'
            );
        }

        return $result;
    }
}