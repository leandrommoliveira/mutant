<?php

namespace App\Http\Controllers\Mutant;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $token = $this->authService
                      ->authenticate(
                          $request->input('email'),
                          $request->input('password')
                      );

        if ($token) {
            return response()->json([
                'token' => $token
            ], 200);
        }

        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }
}
