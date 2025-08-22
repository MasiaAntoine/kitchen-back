# Tests Unitaires - Kitchen Back

Ce projet contient 10 tests unitaires couvrant les fonctionnalités principales de l'application de gestion de cuisine.

## Tests Créés

### 1. **IngredientTest** - Tests du modèle Ingredient

-   Création d'ingrédients avec données valides
-   Relations avec Type, Measure et Balance
-   Attribut `is_connected`
-   Casts des quantités en float

### 2. **BalanceTest** - Tests du modèle Balance

-   Création de balances avec données valides
-   Méthode `isOnline()` basée sur la dernière mise à jour
-   Relations avec les ingrédients
-   Casts des dates

### 3. **TypeTest** - Tests du modèle Type

-   Création de types
-   Relations avec les ingrédients
-   Gestion de plusieurs ingrédients par type

### 4. **MeasureTest** - Tests du modèle Measure

-   Création de mesures avec nom et symbole
-   Relations avec les ingrédients
-   Gestion de plusieurs ingrédients par mesure

### 5. **UserTest** - Tests du modèle User

-   Création d'utilisateurs
-   Masquage des mots de passe
-   Hashage des mots de passe
-   Casts des dates

### 6. **IngredientRequestTest** - Tests de validation

-   Autorisation des requêtes
-   Règles de validation
-   Messages d'erreur personnalisés
-   Validation des données

### 7. **IngredientControllerTest** - Tests du contrôleur

-   Méthodes CRUD (store, show, update, destroy)
-   Gestion des erreurs 404
-   Mise à jour des quantités
-   Gestion des stocks faibles et ingrédients connectés

### 8. **IngredientResourceTest** - Tests de la ressource API

-   Transformation des données
-   Inclusion des relations (type, mesure)
-   Collections d'ingrédients
-   Gestion des IDs de balance

### 9. **ModelRelationshipsTest** - Tests des relations

-   Relations entre tous les modèles
-   Relations one-to-many et one-to-one
-   Relations avec et sans balance

### 10. **BusinessLogicTest** - Tests de la logique métier

-   Calculs de niveaux de stock
-   Détection des stocks faibles
-   Statut en ligne des balances
-   Catégorisation des ingrédients

## Comment Lancer les Tests

### Prérequis

-   PHP 8.2+ installé
-   Composer installé
-   Dépendances du projet installées (`composer install`)

### Lancer tous les tests

```bash
# Depuis la racine du projet
php artisan test
```

### Lancer uniquement les tests unitaires

```bash
php artisan test --testsuite=Unit
```

### Lancer un test spécifique

```bash
# Test d'un modèle spécifique
php artisan test tests/Unit/IngredientTest.php

# Test d'une méthode spécifique
php artisan test --filter test_ingredient_can_be_created_with_valid_data
```

### Lancer les tests avec couverture de code (si Xdebug est installé)

```bash
php artisan test --coverage
```

### Lancer les tests en mode verbose

```bash
php artisan test -v
```

### Lancer les tests avec PHPUnit directement

```bash
./vendor/bin/phpunit
```

## Configuration des Tests

### Base de données

-   Les tests utilisent SQLite en mémoire (`:memory:`)
-   Configuration dans `phpunit.xml`
-   Base de données créée automatiquement pour chaque test

### Factories

-   `UserFactory` - Utilisateurs de test
-   `IngredientFactory` - Ingrédients de test
-   `TypeFactory` - Types d'ingrédients
-   `MeasureFactory` - Unités de mesure
-   `BalanceFactory` - Balances connectées

### Traits utilisés

-   `RefreshDatabase` - Remet à zéro la base de données entre chaque test

## Structure des Tests

Chaque test suit la convention AAA (Arrange, Act, Assert) :

1. **Arrange** : Préparation des données de test
2. **Act** : Exécution de la fonctionnalité testée
3. **Assert** : Vérification des résultats attendus

## Exemple de Test

```php
public function test_ingredient_can_be_created_with_valid_data()
{
    // Arrange - Préparation
    $type = Type::factory()->create();
    $measure = Measure::factory()->create();

    // Act - Exécution
    $ingredient = Ingredient::create([
        'label' => 'Tomate',
        'type_id' => $type->id,
        'measure_id' => $measure->id,
        'quantity' => 500,
        'max_quantity' => 1000,
    ]);

    // Assert - Vérification
    $this->assertInstanceOf(Ingredient::class, $ingredient);
    $this->assertEquals('Tomate', $ingredient->label);
}
```

## Maintenance des Tests

-   Ajouter de nouveaux tests pour chaque nouvelle fonctionnalité
-   Maintenir les tests existants lors de modifications du code
-   Utiliser les factories pour créer des données de test cohérentes
-   Tester les cas limites et les erreurs
