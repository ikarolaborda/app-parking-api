<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function __construct(private readonly User $model) {}

    public function all(): Collection|LengthAwarePaginator
    {
        return $this->model->all();
    }

    public function create(array $attributes): User
    {
        Hash::make($attributes['password']);
        return $this->model->create($attributes);
    }

    public function find(int $id): User|null
    {
        return $this->model->find($id);
    }

    public function findByParam(mixed $param , mixed $search): User|null
    {
            return $this->model
                ->query()
                ->when($param == 'email', function ($query) use ($search) {
                    $query->where('email', $search);
                })
                ->when($param == 'username', function ($query) use ($search) {
                    $query->where('username', $search);
                })
                ->when($param == 'id', function ($query) use ($search) {
                    $query->where('id', $search);
                })
                ->first();
    }

    /**
     * @throws \Exception
     */
    public function update(int $id, array $attributes): User
    {
        $user = $this->find($id);

        if ($user === null) {
            throw new \Exception("User not found.");
        }

        $user->update($attributes);

        return $user;
    }

    /**
     * @throws \Exception
     */
    public function delete(int $id): bool
    {
        $user = $this->find($id);

        if ($user === null) {
            throw new \Exception("User not found.");
        }

        return $user->delete();
    }
}
