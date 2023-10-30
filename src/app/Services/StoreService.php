<?php
namespace App\Services;

use App\Interfaces\AccountEloquentRepositoryInterFace;
use App\Interfaces\StoreEloquentRepositoryInterface;
use App\Traits\Paginations;
use App\Traits\UniqueCodeTrait;
use App\Exceptions\ErrorsException;
use Illuminate\Support\Facades\Hash;

class StoreService
{
    use UniqueCodeTrait, Paginations;
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
            'db_store_number' => $this->codeNumber()
        ]);

        $result = $this->storeEloquentRepository->create($dataStore);

        if ($result->exists) {
            $dataAccount = [
                'db_store_id' => $result->id,
                'db_account_name' => $result->db_store_phone,
                'db_account_password' => Hash::make($data['db_account_password']),
            ];

            return $this->accountEloquentRepository->storeAccount($dataAccount);
        }
    }

    public function searchStore($conditions)
    {
        return $this->paginations(
            $this->storeEloquentRepository->searchStore($conditions),
            $conditions
        );
    }

    public function show($id)
    {
        $result = $this->storeEloquentRepository->show($id);

        if (is_null($result)) {
            throw new ErrorsException(
                "The store not found."
            );
        }

        return $result;
    }

    public function update($storeId, $requestBody)
    {
        $store = $this->storeEloquentRepository->find($storeId);

        if (is_null($store)) {
            throw new ErrorsException(
                'The store not found'
            );
        }

        return $store->update($requestBody);
    }

    public function delete($id)
    {
        $store = $this->storeEloquentRepository->find($id);

        if (is_null($store)) {
            throw new ErrorsException(
                'The store not found'
            );
        }

        return $store->delete();
    }
}