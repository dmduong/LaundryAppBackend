<?php 
namespace App\Helpers;

class Helper
{
    public static function paginate($result, $options = []): array
    {
        return [
            'total' => $result->total(),
            'current_page' => $result->currentPage(),
            'per_page' => $result->perPage(),
            'items' => $result->items(),
        ];
    }
}
