<?php

namespace App\Repositories;

use App\Contracts\ParkingRepositoryInterface;
use App\Models\Parking;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ParkingRepository implements ParkingRepositoryInterface
{

    public function __construct(private readonly Parking $model)
    {
    }

    public function start(int $vehicleId, int $zoneId): Parking
    {
        return $this->model->create([
            'vehicle_id' => $vehicleId,
            'zone_id' => $zoneId,
        ]);
    }

    public function stop(Parking $parking): Parking | bool
    {
        $parking = $this->model->findOrFail($parking->id);

        $start = new Carbon($parking->start_time);
        $stop = (!is_null($parking->stop_time)) ? new Carbon($parking->stop_time) : now();

        $totalTimeByMinutes = $stop->diffInMinutes($start);

        $priceByMinutes = Zone::find($parking->zone_id)->price_per_hour / 60;

        $parking->update([
            'stop_time' => $stop,
            'total_price' => ceil($totalTimeByMinutes * $priceByMinutes)
        ]);

        return $parking;
    }

    public function getActiveParking(int $vehicleId): ?array
    {
        return $this->model->where('vehicle_id', $vehicleId)->active()->first()?->toArray();
    }

    public function getActiveParkings(): Collection | array
    {
        return $this->model->active()->get()->toArray();
    }

    public function getStoppedParkings(): Collection|array
    {
        return $this->model->stopped()->get()->toArray();
    }
}
