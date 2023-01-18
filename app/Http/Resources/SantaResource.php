<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SantaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'santa' => [
                'id' => $this->id,
                'name' => $this->name,
            ],
            'ward' => [
                'id' => $this->ward->id,
                'name' => $this->ward->name,
            ],
        ];
    }
}
