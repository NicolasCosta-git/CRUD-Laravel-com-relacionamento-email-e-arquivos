<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\PasswordReset;

class AuthController extends BaseController
{
    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Erro de validação', $validator->errors(), 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken($user->email . '-' . now());
            return $this->sendResponse(['token' => $token->accessToken]);
        } else {
            return $this->sendError('Email ou senha inválidos', [], 404);
        }
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Este email não está cadastrado',
            ], 404);
        }

        $token = app('auth.password.broker')->createToken($user);
        DB::table(config('auth.passwords.users.table'))->insert([
            'email' => $user->email,
            'token' => $token,
        ]);

        $user->notify(new PasswordReset($token));

        return response()->json([
            'message' => 'Nós enviamos um email de recuperação para o email cadastrado.'
        ]);
    }
}
