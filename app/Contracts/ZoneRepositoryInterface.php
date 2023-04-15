<?php

namespace App\Contracts;

use App\Models\Zone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ZoneRepositoryInterface
{
    public function all(): Collection|LengthAwarePaginator;

    public function create(array $attributes): Zone;

    public function find(mixed $param, mixed $value): Zone | null;

    public function update(int $id, array $attributes): Zone | string;

    public function delete(int $id): bool;

}
