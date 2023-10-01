<?php

namespace App\Traits;

use Carbon\Carbon;

trait CreateDateTimeFromTimestamp
{
    public function timestampToDateTime(string $timestamp): string
    {
        return $timestamp ? Carbon::createFromDate(date($timestamp))->format('Y/m/d H:i:s') : null;
    }

    public function timestampToDate(string $timestamp): string
    {
        return $timestamp ? Carbon::createFromDate(date($timestamp))->format('Y/m/d') : null;
    }
}