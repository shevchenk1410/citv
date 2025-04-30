<?php namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function doLogin()
    {
        // Realiza la autenticacion haciendo una consulta a la base de datos preguntando por el dni
        $user = Usuario::where('dni', request('dni'))->first();

        // Si el usuario no existe, retorna un error 401
        if (!$user || !Hash::check(request('password'), $user->password)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // Si el usuario existe, se genera un token de autenticacion
        $token = $user->createToken('auth_token')->plainTextToken;

        // Se retorna el token de autenticacion
        return response()->json([
            'token' => $token,
        ]);
    }

    public function doLogout()
    {
        // Se revoca el token de autenticacion
        auth()->user()->tokens()->delete();

        // Se retorna un mensaje de exito
        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}