<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @group Authentification
     * @title Se connecter à l'application
     * @description Cette route permet de vérifier les identifiants de connexion et d'authentifier l'utilisateur.
     *
     * @bodyParam username string required Nom d'utilisateur pour l'authentification. Example: {{api_username}}
     * @bodyParam password string required Mot de passe pour l'authentification. Example: {{api_password}}
     *
     * @response 200 success {
     *  "status": "success",
     *  "message": "Authentification réussie"
     * }
     *
     * @response 401 error {
     *  "status": "error",
     *  "message": "Identifiants invalides"
     * }
     */
    public function login(Request $request): JsonResponse
    {
        // Charger les variables d'environnement (comme dans votre middleware)
        $dotenv = \Dotenv\Dotenv::createImmutable(base_path());
        $dotenv->load();

        $correctUsername = env('BASIC_AUTH_USERNAME');
        $correctPassword = env('BASIC_AUTH_PASSWORD');

        // Récupérer les identifiants de la requête
        $username = $request->input('username');
        $password = $request->input('password');

        // Vérifier les identifiants
        if ($username === $correctUsername && $password === $correctPassword) {
            return response()->json([
                'status' => 'success',
                'message' => 'Authentification réussie'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Identifiants invalides'
        ], 401);
    }
}
