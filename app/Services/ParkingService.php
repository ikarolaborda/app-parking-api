<?php

namespace App\Services;

use App\Http\Resources\ParkingResource;
use App\Models\Parking;
use App\Models\Zone;
use App\Repositories\ParkingRepository;
use Carbon\Carbon;

class ParkingService
{

    public function __construct(private readonly ParkingRepository $parkingRepository)
    {
    }

    public function start(int $vehicleId, int $zoneId): array | Parking
    {
        return $this->parkingRepository->start($vehicleId, $zoneId);
    }

    public function stop(Parking $parking): array | ParkingResource
    {
        return ParkingResource::make($this->parkingRepository->stop($parking));
    }

    public function getActiveParking(int $vehicleId): ?array
    {
        return $this->parkingRepository->getActiveParking($vehicleId);
    }

    public function getActiveParkings(): array
    {
        return $this->parkingRepository->getActiveParkings();
    }

    public function getStoppedParkings(): array
    {
        return $this->parkingRepository->getStoppedParkings();
    }

    public static function calculatePrice(int $zone_id, string $startTime, string $stopTime = null): int
    {
        $start = new Carbon($startTime);
        $stop = (!is_null($stopTime)) ? new Carbon($stopTime) : now();

        $totalTimeByMinutes = $stop->diffInMinutes($start);

        $priceByMinutes = Zone::find($zone_id)->price_per_hour / 60;

        return ceil($totalTimeByMinutes * $priceByMinutes);
    }


}
