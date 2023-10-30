<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait UniqueCodeTrait
{
    public function generateUniqueCode(string $table, string $column, string $columnDate = null): string
    {
        $datePart = now()->format('ymd');
        $lastCode = DB::table($table)
            ->when(!is_null($columnDate), function ($query) use ($columnDate) {
                $query->whereRaw('DATE(CONVERT_TZ(FROM_UNIXTIME(' . $columnDate . '), "UTC", "Asia/Ho_Chi_Minh")) = ?', [Carbon::now()->toDateString()]);
            })
            ->orderBy('id', 'desc')
            ->value($column);

        $sequenceNumber = $lastCode ? intval(substr($lastCode, -4)) + 1 : 1;

        return $datePart . str_pad($sequenceNumber, 4, '0', STR_PAD_LEFT);
    }

    public function codeNumber()
    {
        $datePart = now()->format('ymdhis');
        return $datePart . rand(10000, 99999);
    }

    public function codeActiveAccount()
    {
        return rand(11111, 99999);
    }
}