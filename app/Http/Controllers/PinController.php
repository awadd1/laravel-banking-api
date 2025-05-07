<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PinController extends Controller
{
    public function setupPin(Request $request, UserService $userService): JsonResponse
    {
        $this->validate($request, [
            'pin' => ['required', 'string', 'min:4', 'max:4']
        ]);
        $user = $request->user();
        $userService->setupPin($user, $request->input('pin'));
        return $this->sendSuccess([], 'pin is set successfully');
    }

    public function validatePin(Request $request, UserService $userService): JsonResponse
    {
        $this->validate($request, [
            'pin' => ['required', 'string']
        ]);
        $user = $request->user();
        $isValid = $userService->validatePin($user->id, $request->input('pin'));
        return $this->sendSuccess(['is_valid' => $isValid], 'Pin Validation');
    }
}
