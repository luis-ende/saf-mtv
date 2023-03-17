<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
trait AuthenticateWithAccessTokenTrait
{
    protected function authWithAccessToken(Request $request): bool
    {
        if ($request->has('access_token')) {
            $token = PersonalAccessToken::findToken($request->input('access_token'));
            if ($token) {
                $userId = $token->tokenable_id;
                if ($userId) {
                    $user = Auth::loginUsingId($userId);
                    if (!$request->isJson()) {
                        $request->session()->regenerate();
                    }

                    if (!$user->hasRole('mtv-admin')) {
                        return false;
                    }

                    return true;
                }
            }
        }

        return false;
    }
}