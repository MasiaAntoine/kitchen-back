<?php

// filepath: /Users/antoine/Documents/projet/projet-perso/kitchen-back/bootstrap/app.php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\BasicAuthMiddleware;
use App\Http\Middleware\CorsMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Ajouter CORS middleware personnalisé
        $middleware->prepend(CorsMiddleware::class);

        // Alias de votre middleware d'authentification
        $middleware->alias([
            'auth.basic.custom' => BasicAuthMiddleware::class,
        ]);

        // Désactiver CSRF pour les routes spécifiées
        $middleware->validateCsrfTokens(except: [
            'login',
            'ingredients/*',
            'ingredients',
            'types',
            'measures',
            'connected-scales',
            'connected-scales/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
