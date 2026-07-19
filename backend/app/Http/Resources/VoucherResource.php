<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,

            'crew' => [
                'name' => $this->crew_name,
                'id'   => $this->crew_id,
            ],

            'flight' => [
                'number' => $this->flight_number,
                'date'   => $this->flight_date,
                'aircraft' => $this->aircraft_type,
            ],

            'seats' => [
                $this->seat1,
                $this->seat2,
                $this->seat3,
            ],
        ];
    }
}
