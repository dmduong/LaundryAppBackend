<?php 
namespace App\Helpers;

class Helper
{
    public static function paginations($result, $options = []): array
    {
        return [
            'total' => $result->total(),
            'current_page' => $result->currentPage(),
            'per_page' => $result->perPage(),
            'items' => $result->items(),
        ];
    }
}
