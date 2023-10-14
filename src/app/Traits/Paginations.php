<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Paginations
{
    public function orderByRaw(array $order_by, string $sort): string
    {
        return implode(
            ', ',
            array_map(
                function ($order_by) use ($sort) {
                    return $order_by . ' ' . Str::upper($sort);
                },
                $order_by
            )
        );
    }

    public function paginations($query, $conditions)
    {
        return $query
            ->orderByRaw(
                $this->orderByRaw(
                    !empty($conditions['order_by']) ? $conditions['order_by'] : ['created_at'],
                    !empty($conditions['sort']) ? $conditions['sort'] : "desc"
                )
            )->paginate(
                !empty($conditions['limit']) ? $conditions['limit'] : 10
            )
            ->withQueryString(
                !empty($conditions['page']) ? $conditions['page'] : 1
            );
    }
}