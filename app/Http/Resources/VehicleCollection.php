<?php

namespace App\Http\Resources;

use App\Models\Agency;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return VehicleResource::collection($this->collection);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request)
    {
        return [
            'additional' => [
                'combos' => [
                    'agencies' => Agency::fetchCombo(),
                ],
                'info' => null,
            ],
        ];
    }
}
