# 🍳 Kitchen Backend

## 📝 Description

Ce projet est une API qui gère mon application de cuisine. Elle permet de:

-   Mettre en stock les ingrédients manuellement ou automatiquement via des balances électroniques connectées que je fabrique
-   Générer des listes de courses avec les ingrédients critiques (en rupture ou presque)
-   Proposer des recettes en fonction des ingrédients disponibles dans mon stock

L'API sert de passerelle entre la partie frontend de l'application et les balances connectées, centralisant toutes les données et la logique de gestion des stocks et recettes.

## 🛠️ Installation locale

### ⚙️ Configuration de l'environnement

1. Créez un fichier `.env` à la racine du projet en copiant le fichier `.env.example`:

    ```bash
    cp .env.example .env
    ```

2. Configurez les paramètres de base de données selon votre environnement:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=kitchen_back
    DB_USERNAME=root
    DB_PASSWORD=
    ```

3. Si vous utilisez le déploiement automatique, configurez les variables SSH:

    ```
    SSH_DEPLOY_KEY=votre_clé_ssh
    REMOTE_USER=votre_utilisateur
    REMOTE_HOST=votre_host
    REMOTE_PORT=votre_port
    REMOTE_PATH=votre_chemin/public_html/api
    ```

4. Pour l'authentification basique, définissez:

    ```
    BASIC_AUTH_USERNAME=votre_username
    BASIC_AUTH_PASSWORD=votre_password
    ```

5. Générez une clé d'application Laravel:
    ```bash
    php artisan key:generate
    ```

### 🚀 Lancement de Laravel

```
php artisan serve
```

## 📦 Déploiement

### 🔄 Étapes de déploiement

1. Installation des dépendances (première fois uniquement)

    ```
    pnpm deploy-vendor
    ```

2. Déployer les mises à jour

    ```
    pnpm deploy-api
    ```

3. Se connecter au serveur Hostinger (voir commande SSH dans README_PRIVATE)

4. Vider les caches sur le serveur
    ```
    php artisan cache:clear
    php artisan config:cache
    php artisan view:clear
    php artisan route:clear
    ```

### 🔒 Permissions

-   Dossiers et fichiers du projet: `775`

    ```
    chmod -R 775 kitchen
    ```

-   Fichier .env: `600`
    ```
    chmod 600 kitchen/.env
    ```

## 📚 Documentation de l'API

### 🔄 Génération de la documentation Postman

La documentation de l'API est générée automatiquement à l'aide de [Scribe](https://scribe.knuckles.wtf/laravel/) et peut être exportée vers Postman.

1. Pour générer manuellement la documentation:

    ```bash
    pnpm generate-postman
    ```

2. La documentation est également générée automatiquement lors du déploiement avec la commande `pnpm deploy-api`.

3. Configuration requise dans le fichier `.env`:

    ```
    POSTMAN_API_KEY=key_api_postman        # Clé API de votre compte Postman
    POSTMAN_COLLECTION_ID=id_collection_postman  # ID de votre collection existante (optionnel)
    ```

Cela permet de maintenir à jour votre collection Postman avec les dernières modifications de l'API.
