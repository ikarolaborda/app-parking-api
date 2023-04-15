<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPasswordUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasswordUpdateController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function __invoke(UserPasswordUpdateRequest $request): JsonResponse
    {
        if(!$request->validated()) {
            return response()->json([
                'message' => 'Invalid current password',
            ], 401);
        }
        $this->userService->updateUser(auth()->user()->id, $request->validated());
        return response()->json([
            'message' => 'Password updated successfully',
        ], Response::HTTP_ACCEPTED);
    }
}
