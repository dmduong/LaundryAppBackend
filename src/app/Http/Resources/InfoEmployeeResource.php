<?php

namespace App\Http\Resources;

use App\Traits\CreateDateTimeFromTimestamp;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoEmployeeResource extends JsonResource
{

    use CreateDateTimeFromTimestamp;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $store = $this->store;

        return [
            'id' => $this->id,
            'db_employee_number' => $this->db_employee_number,
            'db_employee_name' => $this->db_employee_name,
            'db_store_image' => $this->db_store_image,
            'db_employee_gender' => $this->db_employee_gender,
            'db_employee_birthday' => $this->db_employee_birthday,
            'db_employee_phone' => $this->db_employee_phone,
            'db_employee_email' => $this->db_employee_email,
            'db_employee_image' => $this->db_employee_image,
            'db_employee_address' => $this->db_employee_address,
            'db_employee_status' => $this->db_employee_status,
            'db_employee_created_at' => $this->timestampToDateTime($this->db_employee_created_at),
            'db_employee_updated_at' => $this->timestampToDateTime($this->db_employee_updated_at),
            'db_store' => [
                'id' => $store->id,
                'db_store_number' => $store->db_store_number,
                'db_store_name' => $store->db_store_name,
                'db_store_phone' => $store->db_store_phone,
                'db_store_status' => $store->db_store_status
            ],
        ];
    }
}