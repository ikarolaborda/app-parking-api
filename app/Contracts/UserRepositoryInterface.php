<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection|LengthAwarePaginator;

    public function create(array $attributes): User;

    public function find(int $id): User|null;

    public function update(int $id, array $attributes): User | string;

    public function delete(int $id): bool;

}
