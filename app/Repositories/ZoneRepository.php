<?php

namespace App\Repositories;

use App\Contracts\ZoneRepositoryInterface;
use App\Exceptions\ZoneNotFoundException;
use App\Models\Zone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ZoneRepository implements ZoneRepositoryInterface
{
    public function __construct(private readonly Zone $model)
    {
    }


    public function all(): Collection | LengthAwarePaginator
    {
        return $this->model->all();
    }

    public function create(array $attributes): Zone
    {
        return $this->model->create($attributes);
    }

    public function find(mixed $param, mixed $value): Zone|null
    {
        return $this->model
            ->query()
            ->when($param == 'id', function ($query) use ($value) {
                $query->where('id', $value);
            })
            ->when($param == 'name', function ($query) use ($value) {
                $query->where('name', $value);
            })
            ->first();
    }

    /**
     * @throws ZoneNotFoundException
     */
    public function update(int $id, array $attributes): Zone|string
    {
        try {
            $zone = $this->find('id', $id);
            $zone->update($attributes);
            return $zone;
        }catch (ZoneNotFoundException $e) {
            throw new ZoneNotFoundException($e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $zone = $this->find('id', $id);
            return $zone->delete();
        }catch (ZoneNotFoundException $e) {
            return false;
        }
    }
}
