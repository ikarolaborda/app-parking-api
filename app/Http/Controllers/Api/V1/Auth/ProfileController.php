<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function show(): JsonResponse
    {
        return response()->json([
            'user' => new UserResource(auth()->user()),
        ]);
    }

    public function update(UserUpdateRequest $request): JsonResponse
    {
        $this->userService->updateUser(auth()->user()->id, $request->validated());
        return response()->json([
            'message' => 'User updated successfully',
            Response::HTTP_ACCEPTED
        ]);
    }
}
