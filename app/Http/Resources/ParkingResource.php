<?php

namespace App\Http\Resources;

use App\Services\ParkingService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $totalPrice = $this->total_price ?? ParkingService::calculatePrice(
            $this->zone_id,
            $this->start_time,
            $this->stop_time
        );

        return [
            'id' => $this->id,
            'zone' => [
                'name' => match ($this->zone->name) {
                    'Blue Zone' => 'Blue Zone (Vehicles owned by people with disabilities or over 65 years old)',
                    'Green Zone' => 'Green Zone (Regular vehicles)',
                    'Yellow Zone' => 'Yellow Zone (heavy/lightweight cargo vehicles)',
                    default => $this->zone->name,
                },
                'price_per_hour' => (float)number_format($this->zone->price_per_hour, 2)
            ],
            'vehicle' => [
                'plate_number' => $this->vehicle->plate_number
            ],
            'start_time' => $this->start_time->toDateTimeString(),
            'stop_time' => $this->stop_time?->toDateTimeString(),
            'total_price' => $this->total_price == null ? $totalPrice : number_format($this->total_price, 2)
        ];

    }
}
