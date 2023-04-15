<?php

namespace App\Repositories;

use App\Contracts\VehicleRepositoryInterface;
use App\Exceptions\VehicleNotFoundException;
use App\Models\Vehicle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class VehicleRepository implements VehicleRepositoryInterface
{

    public function __construct(private readonly Vehicle $model)
    {
    }

    public function all(): Collection|LengthAwarePaginator
    {
        return $this->model->all();
    }

    public function create(array $attributes): Vehicle
    {
        return $this->model->create($attributes);
    }

    public function find(mixed $param, mixed $value): Vehicle|null
    {
        return $this->model
            ->query()
            ->when($param == 'id', function ($query) use ($value) {
                $query->where('id', $value);
            })
            ->when($param == 'plate_number', function ($query) use ($value) {
                $query->where('plate_number', $value);
            })
            ->first();
    }

    public function update(int $id, array $attributes): Vehicle | string
    {
        try {
            $vehicle = $this->find('id', $id);
            $vehicle->update($attributes);
            return $vehicle;
        }catch (VehicleNotFoundException $e) {
            return $e->getMessage();
        }
    }

    public function delete(int $id): bool
    {
        try {
            $vehicle = $this->find('id', $id);
            return $vehicle->delete();
        }catch (VehicleNotFoundException $e) {
            return false;
        }
    }
}
