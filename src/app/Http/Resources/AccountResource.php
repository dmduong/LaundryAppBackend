<?php

namespace App\Http\Resources;

use App\Traits\CreateDateTimeFromTimestamp;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{

    use CreateDateTimeFromTimestamp;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'db_account' => [
                'id' => $this->id,
                'db_account_name' => $this->db_account_name
            ],
            'db_employee' => $this->getEmployee($this->employee),
            'token' => [
                'db_account_token' => $this->db_account_token,
                'db_account_refresh_token' => $this->db_account_refresh_token,
            ]
        ];
    }

    protected function getStore($content)
    {
        return [
            'id' => $content->id,
            'db_store_number' => $content->db_store_number,
            'db_store_name' => $content->db_store_name
        ];
    }

    protected function getEmployee($content)
    {
        return [
            'id' => $content->id,
            'db_store_id' => $content->db_store_id,
            'db_employee_number' => $content->db_employee_number,
            'db_employee_name' => $content->db_employee_name
        ];
    }
}