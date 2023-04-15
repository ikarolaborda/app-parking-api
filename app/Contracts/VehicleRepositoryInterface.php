<?php

namespace App\Contracts;

use App\Models\Vehicle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface VehicleRepositoryInterface
{

    public function all(): Collection|LengthAwarePaginator;

    public function create(array $attributes): Vehicle;

    public function find(mixed $param, mixed $value): Vehicle|null;

    public function update(int $id, array $attributes): Vehicle | string;

    public function delete(int $id): bool;

}
