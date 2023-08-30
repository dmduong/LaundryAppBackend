<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait UniqueCodeTrait
{
    public function generateUniqueCode(string $table, string $column, string $columnDate = null): string
    {
        $datePart = now()->format('ymd');

        $lastCode = DB::table($table)
            ->when(!is_null($columnDate), function ($query) use ($columnDate) {
                $query->whereDate($columnDate, now()->timestamp);
            })
            ->orderBy('id', 'desc')
            ->value($column);

        $sequenceNumber = $lastCode ? intval(substr($lastCode, -4)) + 1 : 1;

        return $datePart . str_pad($sequenceNumber, 4, '0', STR_PAD_LEFT);
    }
}