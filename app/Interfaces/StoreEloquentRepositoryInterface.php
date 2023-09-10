<?php

namespace App\Interfaces;

interface StoreEloquentRepositoryInterface
{
    public function show(int $id);

    public function create(array $data);

    public function searchStore(array $conditions);
}