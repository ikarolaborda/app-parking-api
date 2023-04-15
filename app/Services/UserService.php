<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function register(array $data): User | null
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    /**
     * @throws InvalidCredentialsException
     */
    public function login(array $userdata): User | null
    {
        $user = $this->userRepository->findByParam('email', $userdata['email']);
        if (! $user ||  ! Hash::check($userdata['password'], $user->password)) {
            throw new InvalidCredentialsException('Invalid credentials');
        }
        return $user;
    }

    public function getAllUsers(): Collection | LengthAwarePaginator
    {
        return $this->userRepository->all();
    }

    public function updateUser(int $id, array $data): User | null
    {
        return $this->userRepository->update($id, $data);
    }
}
