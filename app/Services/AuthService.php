<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class AuthService
{
    private $jwt;

    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    protected function jwt(User $user)
    {
        $payload = [
            'iss' => 'lumen-jwt',
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60 * 60
        ];

        return $this->jwt::encode($payload, env('JWT_SECRET'));
    }

    public function authenticate($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return null;
        }

        if (Hash::check($password, $user->password)) {
            return $this->jwt($user);
        }

        return null;
    }
}
