<?php

namespace App\Interfaces;

interface AccountEloquentRepositoryInterFace
{
    public function storeAccount(array $data);

    public function checkUserLogin(array $data);
}