<?php

namespace App\Contracts;

use App\Models\Parking;
use Illuminate\Support\Collection;

interface ParkingRepositoryInterface
{
    public function start(int $vehicleId, int $zoneId): Parking;

    public function stop(Parking $parking): Parking | bool;

    public function getActiveParking(int $vehicleId): array | Parking | null;

    public function getActiveParkings(): Collection | array;

    public function getStoppedParkings(): Collection | array;

}
