<?php

namespace App\Http\Resources;

use App\Traits\CreateDateTimeFromTimestamp;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAllStoreResource extends JsonResource
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
            'id' => $this->id,
            'db_store_number' => $this->db_store_number,
            'db_store_name' => $this->db_store_name,
            'db_store_phone' => $this->db_store_phone,
            'db_store_image' => $this->db_store_image,
            'db_store_email' => $this->db_store_email,
            'db_store_address' => $this->db_store_address,
            'created_at' => $this->created_at ? $this->timestampToDateTime($this->created_at) : null,
            'updated_at' => $this->updated_at ? $this->timestampToDateTime($this->updated_at) : null
        ];
    }
}