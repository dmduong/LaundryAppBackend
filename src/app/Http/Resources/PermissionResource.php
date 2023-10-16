<?php

namespace App\Http\Resources;

use App\Traits\CreateDateTimeFromTimestamp;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'created_at' => $this->timestampToDateTime($this->created_at),
            'updated_at' => $this->timestampToDateTime($this->updated_at),
        ];
    }
}