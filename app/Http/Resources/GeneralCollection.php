<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GeneralCollection extends ResourceCollection
{
    private $data_key;

    public function __construct($resource, $collects, $key = 'data')
    {
        $this->collects = $collects;
        $this->data_key = $key;
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        try {
            return [
                "$this->data_key" => $this->collection,
                'pagination' => [
                    'total_pages' => $this->lastPage(),
                    'items_per_page' => $this->perPage(),
                    'items_in_this_page' => $this->count(),
                    'current_page' => $this->currentPage(),
                    'previous_page_url' => $this->previousPageUrl(),
                    'next_page_url' => $this->nextPageUrl()
                ]
            ];
        } catch (\Exception $exception) {
            return [
                "$this->data_key" => $this->collection,
            ];
        }
    }
}
