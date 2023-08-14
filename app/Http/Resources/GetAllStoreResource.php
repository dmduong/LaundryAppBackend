<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAllStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'db_store_number' => $this->db_store_number,
            'db_store_name' => $this->db_store_name,
            'db_store_phone' => $this->db_store_phone,
            'db_store_image' => $this->db_store_image,
            'db_store_address' => $this->db_store_address,
            'db_store_created_at' => $this->db_store_created_at,
            'db_store_updated_at' => $this->db_store_updated_at
        ];
    }
}