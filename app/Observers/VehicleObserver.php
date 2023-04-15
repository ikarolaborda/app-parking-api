<?php

namespace App\Observers;

use App\Models\Vehicle;

class VehicleObserver
{
    public function creating(Vehicle $vehicle): void
    {
        if (auth()->check()) {
            $vehicle->user_id = auth()->id();
        }
    }

    public function created(Vehicle $vehicle): void
    {
        //
    }

    public function updated(Vehicle $vehicle): void
    {
        //
    }

    public function deleted(Vehicle $vehicle): void
    {
        //
    }

    public function restored(Vehicle $vehicle): void
    {

    }


    public function forceDeleted(Vehicle $vehicle): void
    {
        //
    }
}
