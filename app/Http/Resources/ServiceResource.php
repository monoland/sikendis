<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
        $details = optional($this->invoice)->items;

        return [
            'id' => $this->id,
            'police_id' => $this->police_id,
            'garage' => [
                'text' => $this->garage->name,
                'value' => $this->garage->id,
            ],
            'periode' => $this->periode,
            'notes' => $this->notes,
            'subtotal' => (float) $this->subtotal,
            'disc' => (float) $this->disc,
            'tax' => (float) $this->tax,
            'total' => (float) $this->total,
            $this->mergeWhen($this->invoice, [
                'date_invoice' => optional($this->invoice)->duedate,
                'refs_invoice' => optional($this->invoice)->refsinv,
            ]),
            'details' => optional($this->invoice)->items ? InvoiceDetail::collection($details) : [],
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
