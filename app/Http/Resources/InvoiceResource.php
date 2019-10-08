<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'id' => $this->id,
            'refsinv' => $this->refsinv,
            'duedate' => $this->duedate,
            'periode' => $this->periode,
            'subtotal' => $this->subtotal,
            'disc' => $this->disc,
            'tax' => $this->tax,
            'total' => $this->total,
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
