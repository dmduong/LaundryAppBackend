<?php
namespace App\Services;

use App\Interfaces\StoreEloquentRepositoryInterface;
use App\Traits\UniqueCodeTrait;
use App\Exceptions\ResourceNotFoundException;

class StoreService
{
    use UniqueCodeTrait;
    protected StoreEloquentRepositoryInterface $storeEloquentRepository;

    public function __construct(StoreEloquentRepositoryInterface $storeEloquentRepository)
    {
        $this->storeEloquentRepository = $storeEloquentRepository;
    }

    public function createStore($data)
    {
        $data = array_merge($data, [
            'db_store_number' => $this->generateUniqueCode(
                'stores',
                'db_store_number',
                'db_store_created_at'
            )
        ]);

        return $this->storeEloquentRepository->create($data);
    }

    public function getAll()
    {
        return $this->storeEloquentRepository->getAll();
    }

    public function show($id)
    {
        $result = $this->storeEloquentRepository->show($id);

        if (is_null($result)) {
            throw new ResourceNotFoundException("The store not found.", 'store_not_found');
        }

        return $result;
    }
}