<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

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
            'vehicle' => [
                'text' => $this->police_id . ' - ' . $this->agency->name . ' an: ' . $this->vehicle->name,
                'agency_id' => $this->agency_id,
                'value' => $this->vehicle_id,
                'name' => optional($this->vehicle)->name,
                'brand' => optional($this->vehicle)->brand->name,
                'type' => optional($this->vehicle)->type->name,
                'year' => optional($this->vehicle)->year
            ],
            'garage' => [
                'text' => optional($this->garage)->name,
                'value' => optional($this->garage)->id,
                'address' => optional($this->garage)->address,
                'phone' => optional($this->garage)->phone
            ],
            'periode' => $this->periode,
            'status' => $this->status,
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
