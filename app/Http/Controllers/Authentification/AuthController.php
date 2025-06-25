<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\AuthTokenResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     *  Registro de Usuario
     *
     * Registra un nuevo usuario en el sistema.
     *
     * @group Autenticación
     * 
     * @bodyParam name string required Nombre del usuario. Example: Username Test
     * @bodyParam email string required Correo electrónico válido. Example: test@example.com
     * @bodyParam password string required Contraseña segura. Example: password
     * @bodyParam password_confirmation string required Confirmación de la contraseña. Example: password
     * 
     * @response 200 {
     *   "access_token": "token.jwt",
     *   "token_type": "bearer",
     *   "expires_in": 3600
     * }
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = auth('api')->login($user);

        return $this->respondWithToken($token);
    }

    /**
     *  Login de Usuario
     *
     * Autentica a un usuario registrado y devuelve un token JWT.
     *
     * @group Autenticación
     * 
     * @bodyParam email string required Correo del usuario. Example: user@example.com
     * @bodyParam password string required Contraseña del usuario. Example: password
     *
     * @response 200 {
     *   "access_token": "token.jwt",
     *   "token_type": "bearer",
     *   "expires_in": 3600
     * }
     * 
     * @response 401 {
     *   "error": "Estas credenciales no coinciden con nuestros registros."
     * }
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'error' => __('auth.failed'),
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token) : AuthTokenResource
    {
        return new AuthTokenResource($token);
    }

    /**
     * Cerrar Sesión
     *
     * Cierra la sesión del usuario autenticado invalidando su token.
     *
     * @group Autenticación
     * @authenticated
     * @header Authorization Bearer {token}
     * 
     * 
     * @response 200 {
     *   "message": "Sesión cerrada correctamente"
     * }
    */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => __('auth.logged_out')]);
    }
}
