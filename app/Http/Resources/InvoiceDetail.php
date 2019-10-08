<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->mergeWhen($this->pivot, [
                'value' => $this->id,
                'text' => $this->name,
                'unit' => $this->unit,
                'qty' => $this->pivot->qty,
                'price' => $this->pivot->price,
                'amount' => $this->pivot->amount,
                'notes' => $this->pivot->notes,
            ]),
        ];
    }
}
