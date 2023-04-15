<?php

namespace App\Services;

use App\Http\Resources\VehicleResource;
use App\Repositories\VehicleRepository;

class VehicleService
{
    public function __construct(private readonly VehicleRepository $repository)
    {
    }

    public function all(): VehicleResource
    {
        return new VehicleResource($this->repository->all());
    }

    public function create(array $attributes): VehicleResource
    {
        $vehicle = $this->repository->create($attributes);
        return new VehicleResource($vehicle);
    }

    public function find(mixed $param, mixed $value): VehicleResource|string
    {
        $vehicle = $this->repository->find($param, $value);
        return new VehicleResource($vehicle);
    }

    public function update(int $id, array $attributes): VehicleResource|string
    {
        $vehicle = $this->repository->update($id, $attributes);
        if (is_string($vehicle)) {
            return $vehicle;
        }
        return new VehicleResource($vehicle);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

}
