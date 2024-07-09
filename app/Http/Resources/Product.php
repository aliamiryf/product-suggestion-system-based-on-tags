<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class Product extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'file' => new File($this->whenLoaded('file')),
            'categories' => Categories::collection($this->whenLoaded('categories')),
            'tage' => Tag::collection($this->whenLoaded('tags')),
            'active_price' => Price::collection($this->whenLoaded('active_price'))
        ];
    }
}
