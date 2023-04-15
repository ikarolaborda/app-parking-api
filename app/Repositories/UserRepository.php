<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Exceptions\UserNotFoundException;
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
     * @throws UserNotFoundException
     */
    public function update(int $id, array $attributes): User | string
    {
        try {
            $user = $this->find($id);
            $user->update($attributes);
            return $user;
        }catch (UserNotFoundException $e) {
            throw new UserNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws UserNotFoundException
     */
    public function delete(int $id): bool
    {
        try {
            $user = $this->find($id);
            return $user->delete();
        }catch (UserNotFoundException $e) {
            throw new UserNotFoundException($e->getMessage());
        }
    }
}
