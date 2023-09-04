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
            'db_account' => !is_null($this->account) ? $this->getAccount($this->account) : [],
            'db_store_image' => $this->db_store_image,
            'db_store_address' => $this->db_store_address,
            'db_store_created_at' => $this->db_store_created_at ? $this->timestampToDateTime($this->db_store_created_at) : null,
            'db_store_updated_at' => $this->db_store_updated_at ? $this->timestampToDateTime($this->db_store_updated_at) : null
        ];
    }

    private function getAccount($content)
    {
        return [
            'id' => $content->id,
            'db_store_id' => $content->db_store_id,
            'db_account_name' => $content->db_account_name,
            'db_account_token' => $content->db_account_token,
            'db_account_refresh_token' => $content->db_account_refresh_token,
            'db_account_status' => $content->db_account_status,
        ];
    }
}