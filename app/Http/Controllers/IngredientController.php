<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Http\Resources\IngredientResource;
use App\Models\Ingredient;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IngredientController extends Controller
{
    /**
     * @group Ingredients
     * @title Récupérer la liste des ingrédients
     * @description Cette route permet de récupérer tous les ingrédients avec leur type et leur unité de mesure.
     *
     * @response 200 success {
     *  "data": [
     *    {
     *      "id": 1,
     *      "label": "Tomate",
     *      "quantity": 10,
     *      "max_quantity": 20,
     *      "mesure": "Grammes"
     *    }
     *  ]
     * }
     */
    public function index(): AnonymousResourceCollection
    {
        $ingredients = Ingredient::with(['type', 'measure'])->get();
        return IngredientResource::collection($ingredients);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(IngredientRequest $request): IngredientResource
    {
        $validated = $request->validated();
        $ingredient = Ingredient::create($validated);
        $ingredient->load(['type', 'measure']);

        return new IngredientResource($ingredient);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): IngredientResource|JsonResponse
    {
        $ingredient = Ingredient::with(['type', 'measure'])->find($id);

        if (!$ingredient) {
            return response()->json(['message' => 'Ingrédient non trouvé'], 404);
        }

        return new IngredientResource($ingredient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IngredientRequest $request, string $id): IngredientResource|JsonResponse
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json(['message' => 'Ingrédient non trouvé'], 404);
        }

        $validated = $request->validated();
        $ingredient->update($validated);
        $ingredient->load(['type', 'measure']);

        return new IngredientResource($ingredient);
    }

    /**
     * @group Ingredients
     * @title Supprimer un ingrédient
     * @description Cette route permet de supprimer un ingrédient spécifique.
     *
     * @urlParam id required L'identifiant de l'ingrédient à supprimer. Example: 1
     *
     * @response 200 success {
     *  "message": "Ingrédient supprimé avec succès"
     * }
     *
     * @response 404 not_found {
     *  "message": "Ingrédient non trouvé"
     * }
     */
    public function destroy(string $id): JsonResponse
    {
        $ingredient = Ingredient::find($id);

        if (!$ingredient) {
            return response()->json(['message' => 'Ingrédient non trouvé'], 404);
        }

        $ingredient->delete();

        return response()->json(['message' => 'Ingrédient supprimé avec succès'], 200);
    }

    /**
     * @group Ingredients
     * @title Mettre à jour la quantité d'un ingrédient
     * @description Cette route permet de mettre à jour uniquement la quantité d'un ingrédient.
     *
     * @urlParam id required L'identifiant de l'ingrédient à modifier. Example: 1
     * @bodyParam quantity numeric required La nouvelle quantité de l'ingrédient. Example: 500
     *
     * @response 200 success {
     *  "status": "success",
     *  "message": "Quantité mise à jour avec succès",
     *  "data": {
     *    "id": 1,
     *    "label": "Tomate",
     *    "quantity": 500,
     *    "max_quantity": 1000,
     *    "mesure": "Grammes"
     *  }
     * }
     *
     * @response 404 not_found {
     *  "message": "Ingrédient non trouvé"
     * }
     */
    public function updateQuantity(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        $ingredient = Ingredient::findOrFail($id);

        $ingredient->quantity = $validated['quantity'];
        $ingredient->save();

        $ingredient->load(['type', 'measure']);

        return response()->json([
            'status' => 'success',
            'message' => 'Quantité mise à jour avec succès',
            'data' => new IngredientResource($ingredient)
        ]);
    }

    /**
     * @group Ingredients
     * @title Récupérer les ingrédients par type
     * @description Cette route permet de récupérer tous les ingrédients non connectés, regroupés par type.
     *
     * @response 200 success {
     *  "Légumes": {
     *    "items": [
     *      {
     *        "id": 1,
     *        "label": "Tomate",
     *        "quantity": 500,
     *        "max_quantity": 1000,
     *        "mesure": "Grammes"
     *      }
     *    ]
     *  },
     *  "Viandes": {
     *    "items": [
     *      {
     *        "id": 3,
     *        "label": "Steack",
     *        "quantity": 1000,
     *        "max_quantity": 2000,
     *        "mesure": "Grammes"
     *      }
     *    ]
     *  }
     * }
     */
    public function getIngredientsByType(): JsonResponse
    {
        // Récupérer tous les types avec leurs ingrédients non connectés
        $types = Type::with(['ingredients' => function($query) {
            $query->whereNull('id_balance')->with('measure');
        }])->get();

        $result = [];

        // Grouper les ingrédients par type
        foreach ($types as $type) {
            $result[$type->name] = [
                'items' => IngredientResource::collection($type->ingredients)->toArray(request())
            ];
        }

        return response()->json($result);
    }

    /**
     * @group Ingredients
     * @title Créer un nouvel ingrédient
     * @description Cette route permet de créer un nouvel ingrédient avec des valeurs par défaut.
     *
     * @bodyParam label string required Le nom de l'ingrédient. Example: Courgette
     * @bodyParam is_connected boolean Indique si l'ingrédient est connecté à un capteur. Example: false
     * @bodyParam type_id integer required L'identifiant du type d'ingrédient. Example: 1
     * @bodyParam measure_id integer required L'identifiant de l'unité de mesure. Example: 1
     * @bodyParam max_quantity numeric required La quantité maximale de l'ingrédient. Example: 1000
     *
     * @response 201 success {
     *  "status": "success",
     *  "message": "Ingrédient créé avec succès",
     *  "data": {
     *    "id": 5,
     *    "label": "Courgette",
     *    "quantity": 0,
     *    "max_quantity": 1000,
     *    "mesure": "Grammes"
     *  }
     * }
     *
     * @response 422 validation_error {
     *  "message": "The given data was invalid.",
     *  "errors": {
     *    "label": ["Le champ label est obligatoire."],
     *    "type_id": ["Le champ type_id doit être un identifiant existant dans la table types."]
     *  }
     * }
     */
    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'id_balance' => 'nullable|string|max:255',
            'type_id' => 'required|exists:types,id',
            'measure_id' => 'required|exists:measures,id',
            'max_quantity' => 'required|numeric|min:0',
        ]);

        // Ajouter les valeurs par défaut pour quantity
        $validated['quantity'] = 0;

        $ingredient = Ingredient::create($validated);
        $ingredient->load(['type', 'measure']);

        return response()->json([
            'status' => 'success',
            'message' => 'Ingrédient créé avec succès',
            'data' => new IngredientResource($ingredient)
        ], 201);
    }

    /**
     * @group Ingredients
     * @title Récupérer les ingrédients en rupture de stock
     * @description Cette route permet de récupérer tous les ingrédients dont la quantité est inférieure ou égale à 50% de la quantité maximale.
     *
     * @response 200 success {
     *  "status": "success",
     *  "data": [
     *    {
     *      "id": 2,
     *      "label": "Poulet",
     *      "quantity": 0,
     *      "max_quantity": 2000,
     *      "mesure": "Grammes"
     *    },
     *    {
     *      "id": 5,
     *      "label": "Crème fraîche",
     *      "quantity": 250,
     *      "max_quantity": 600,
     *      "mesure": "Grammes"
     *    }
     *  ]
     * }
     */
    public function getLowStockIngredients(): JsonResponse
    {
        $ingredients = Ingredient::with(['type', 'measure'])
            ->whereRaw('quantity <= (max_quantity * 0.5)')
            ->where('max_quantity', '>', 0)  // Éviter la division par zéro
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => IngredientResource::collection($ingredients)
        ]);
    }

    /**
     * @group Ingredients
     * @title Récupérer les ingrédients connectés
     * @description Cette route permet de récupérer tous les ingrédients connectés à des capteurs.
     *
     * @response 200 success {
     *  "status": "success",
     *  "data": [
     *    {
     *      "id": 7,
     *      "label": "Lait",
     *      "quantity": 800,
     *      "max_quantity": 1000,
     *      "mesure": "Millilitres"
     *    },
     *    {
     *      "id": 8,
     *      "label": "Farine",
     *      "quantity": 1200,
     *      "max_quantity": 2000,
     *      "mesure": "Grammes"
     *    }
     *  ]
     * }
     */
    public function getConnectedIngredients(): JsonResponse
    {
        $ingredients = Ingredient::with(['type', 'measure'])
            ->whereNotNull('id_balance')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => IngredientResource::collection($ingredients)
        ]);
    }

    /**
     * @group Ingredients
     * @title Supprimer plusieurs ingrédients
     * @description Cette route permet de supprimer plusieurs ingrédients en une seule requête.
     *
     * @bodyParam ids array required Tableau des identifiants d'ingrédients à supprimer. Example: [1, 2, 3]
     *
     * @response 200 success {
     *  "status": "success",
     *  "message": "3 ingrédient(s) supprimé(s) avec succès",
     *  "count": 3
     * }
     *
     * @response 422 validation_error {
     *  "message": "The given data was invalid.",
     *  "errors": {
     *    "ids": ["Le champ ids est obligatoire."],
     *    "ids.0": ["L'élément sélectionné dans ids.0 est invalide."]
     *  }
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDestroy(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:ingredients,id',
        ]);

        $count = Ingredient::destroy($validated['ids']);

        return response()->json([
            'status' => 'success',
            'message' => $count . ' ingrédient(s) supprimé(s) avec succès',
            'count' => $count
        ], 200);
    }
}
