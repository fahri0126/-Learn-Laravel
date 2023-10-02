<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'harga' => $this->harga,
            'diskon' => $this->diskon,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at
        ];
    }
}
