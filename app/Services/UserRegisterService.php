<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegisterService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function register(array $data): User | null
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }
}
