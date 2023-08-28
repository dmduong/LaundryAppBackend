<?php

namespace App\Interfaces;

interface StoreEloquentRepositoryInterface
{
    public function getDataAlls();
    public function storeDatas(array $data);
}