<?php

namespace App\Services;

use App\Contracts\ZoneRepositoryInterface;
use App\Http\Resources\ZoneResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ZoneService
{
    public function __construct(private readonly ZoneRepositoryInterface $zoneRepository)
    {
    }

    public function all(): AnonymousResourceCollection
    {
        return ZoneResource::collection($this->zoneRepository->all());
    }

}
