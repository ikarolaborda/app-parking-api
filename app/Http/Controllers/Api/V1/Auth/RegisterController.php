<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Contracts\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(UserRegisterRequest $request)
    {
        $user = $this->userRepository->create($request->validated());
        event(new Registered($user));

        $device = substr($request->userAgent() ?? '', 0, 255);

        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ], Response::HTTP_CREATED);
    }
}
