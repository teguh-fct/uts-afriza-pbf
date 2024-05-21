<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Nette\Utils\Random;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthCT extends Controller
{
    public function __construct(private JwtService $jwtService)
    {
        //
    }

    public function oauth_alihkan(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function oauth_panggilan_balik()
    {
        $googleUser = Socialite::driver('google')->user();

        if (!$googleUser->id) {
            return response()->json([
                'message' => 'Google user not found',
            ], 400);
        }

        $user = User::where('google_id', $googleUser->id)->first();

        if (!$user) {
            $user = new User();
            $user->name = $googleUser->name;
            $user->google_id = $googleUser->id;
            $user->google_token = $googleUser->token;
            $user->google_refresh_token = $googleUser->refreshToken;
            $user->password = Hash::make(Random::generate(10));
            $user->email = $googleUser->email;
            $user->save();
        }

        $payload = [
            'user' => [
                'id' => $user->id
            ]
        ];
        $token = $this->jwtService->encode($payload);

        return response()->json([
            'token' => $token
        ]);
    }
}
