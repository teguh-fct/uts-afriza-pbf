<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthApiCT extends Controller
{
    public function __construct(private JwtService $jwtService)
    {
        //
    }

    public function daftar(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        return response()->json([
            'data' => $user->toArray()
        ], 200);
    }

    public function masuk(UserLoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response()->json([
                'validation_error' => [
                    'message' => [
                        'Email atau Password salah.'
                    ]
                ]
            ]);
        }

        $user = Auth::user();
        $payload = [
            'user' => [
                'id' => $user->id
            ]
        ];
        $token = $this->jwtService->encode($payload);

        return response()->json([
            'validation_error' => [
                'kode_token' => $token
            ]
        ]);
    }
}
