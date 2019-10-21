<?php

namespace App\Http\Resources;

use App\Models\Garage;
use App\Models\Item;
use App\Models\Vehicle;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollection extends ResourceCollection
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
        return ServiceResource::collection($this->collection);
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
                    'polices' => Vehicle::where('agency_id', $request->user()->userable->id)->fetchCombo(),
                    'garages' => Garage::fetchCombo(),
                    'items' => Item::fetchCombo(),
                ],
                'info' => null,
            ],
        ];
    }
}
