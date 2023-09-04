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
            'id' => $this->id,
            'db_account_name' => $this->db_account_name,
            'db_account_device' => $this->db_account_device,
            'db_account_status' => $this->db_account_status,
            'db_account_created_at' => $this->db_account_created_at ? $this->timestampToDateTime($this->db_account_created_at) : null,
            'db_account_updated_at' => $this->db_account_updated_at ? $this->timestampToDateTime($this->db_account_updated_at) : null,
            'db_store' => !is_null($this->store) ? $this->getStore($this->store) : null,
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
            'db_store_name' => $content->db_store_name,
            'db_store_phone' => $content->db_store_phone,
            'db_store_email' => $content->db_store_email,
            'db_store_image' => $content->db_store_image,
            'db_store_address' => $content->db_store_address,
            'db_store_status' => $content->db_store_status,
            'db_store_created_at' => $content->db_store_created_at ? $this->timestampToDateTime($content->db_store_created_at) : null,
            'db_store_updated_at' => $content->db_store_updated_at ? $this->timestampToDateTime($content->db_store_updated_at) : null
        ];
    }
}