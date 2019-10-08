<?php

namespace App\Http\Resources;

use App\Models\Authent;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
        return UserResource::collection($this->collection);
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
        if ($request->agency) {
            return [
                'additional' => [
                    'combos' => [
                        'authents' => Authent::fetchCombo($request)->whereNotIn('name', [
                            'administrator',
                        ])->get(),
                    ],

                    'info' => null,
                ],
            ];
        }

        if ($request->garage) {
            return [
                'additional' => [
                    'combos' => [
                        'authents' => Authent::fetchCombo($request)->whereIn('name', [
                            'garage',
                        ])->get(),
                    ],

                    'info' => null,
                ],
            ];
        }

        return [];
    }
}
