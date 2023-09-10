<?php

namespace App\Traits;

use Carbon\Carbon;

trait CreateDateTimeFromTimestamp
{
    public function timestampToDateTime(string $timestamp): string
    {
        return Carbon::createFromTimestamp($timestamp)->format('Y/m/d H:i:s');
    }

    public function timestampToDate(string $timestamp): string
    {
        return Carbon::createFromTimestamp($timestamp)->format('Y/m/d');
    }
}