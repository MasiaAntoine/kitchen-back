<?php

namespace App\Http\Controllers;

use App\Http\Resources\IngredientResource;
use App\Models\Balance;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BalanceController extends Controller
{
    /**
     * @group Balances
     * @title Récupérer la liste des balances
     * @description Cette route permet de récupérer toutes les balances connectées avec leurs adresses MAC et noms.
     *
     * @response 200 success {
     *  "data": [
     *    {
     *      "id": 1,
     *      "mac_address": "00:11:22:33:44:55",
     *      "name": "Balance cuisine",
     *      "is_online": true,
     *    },
     *    {
     *      "id": 2,
     *      "mac_address": "AA:BB:CC:DD:EE:FF",
     *      "name": "Balance salle de bain",
     *      "is_online": false,
     *    }
     *  ]
     * }
     */
    public function index(): JsonResponse
    {
        $balances = Balance::select('id', 'mac_address', 'name')
            ->get()
            ->map(function ($balance) {
                return [
                    'id' => $balance->id,
                    'mac_address' => $balance->mac_address,
                    'name' => $balance->name,
                    'is_online' => $balance->isOnline(),
                ];
            });

        return response()->json($balances);
    }

    /**
     * @group Balances
     * @title Ajouter une nouvelle balance
     * @description Cette route permet d'ajouter une nouvelle balance avec son adresse MAC et son nom.
     *
     * @bodyParam mac_address string required L'adresse MAC de la balance. Example: 00:11:22:33:44:55
     * @bodyParam name string required Le nom de la balance. Example: Balance cuisine
     *
     * @response 201 success {
     *  "data": {
     *    "id": 3,
     *    "mac_address": "00:11:22:33:44:55",
     *    "name": "Balance cuisine",
     *    "is_online": false,
     *    "last_update": null
     *  },
     *  "message": "Balance créée avec succès"
     * }
     *
     * @response 422 validation_error {
     *  "message": "Le champ adresse MAC est obligatoire",
     *  "errors": {
     *    "mac_address": [
     *      "Le champ adresse MAC est obligatoire"
     *    ]
     *  }
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'mac_address' => 'required|string|unique:balances,mac_address',
            'name' => 'required|string|max:255',
        ], [
            'mac_address.required' => 'Le champ adresse MAC est obligatoire',
            'mac_address.unique' => 'Cette adresse MAC est déjà enregistrée',
            'name.required' => 'Le champ nom est obligatoire',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $balance = Balance::create([
            'mac_address' => $request->mac_address,
            'name' => $request->name,
        ]);

        return response()->json([
            'data' => [
                'id' => $balance->id,
                'mac_address' => $balance->mac_address,
                'name' => $balance->name,
                'is_online' => false,
                'last_update' => null,
            ],
            'message' => 'Balance créée avec succès'
        ], 201);
    }


    /**
     * @group Balances
     * @title Associer une balance à un ingrédient
     * @description Cette route permet d'associer une balance existante à un ingrédient existant.
     * Une balance ne peut être associée qu'à un seul ingrédient à la fois.
     *
     * @urlParam balance_id required L'identifiant de la balance à associer. Example: 1
     * @bodyParam ingredient_id integer required L'identifiant de l'ingrédient à associer à la balance. Example: 3
     *
     * @response 200 success {
     *  "status": "success",
     *  "message": "Balance associée avec succès à l'ingrédient",
     *  "data": {
     *    "balance": {
     *      "id": 1,
     *      "mac_address": "00:11:22:33:44:55",
     *      "name": "Balance cuisine"
     *    },
     *    "ingredient": {
     *      "id": 3,
     *      "label": "Farine",
     *      "quantity": 500,
     *      "max_quantity": 1000,
     *      "mesure": "Grammes"
     *    }
     *  }
     * }
     *
     * @response 404 not_found {
     *  "message": "Balance ou ingrédient non trouvé"
     * }
     *
     * @response 422 already_associated {
     *  "message": "Cette balance est déjà associée à un autre ingrédient",
     *  "ingredient": {
     *    "id": 5,
     *    "label": "Sucre"
     *  }
     * }
     */
    public function associateWithIngredient(Request $request, $balance_id): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'ingredient_id' => 'required|exists:ingredients,id',
        ], [
            'ingredient_id.required' => 'L\'identifiant de l\'ingrédient est obligatoire',
            'ingredient_id.exists' => 'Cet ingrédient n\'existe pas',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        // Récupération de la balance et de l'ingrédient
        $balance = Balance::find($balance_id);
        $ingredient = Ingredient::find($request->ingredient_id);

        if (!$balance || !$ingredient) {
            return response()->json(['message' => 'Balance ou ingrédient non trouvé'], 404);
        }

        // Vérifier si la balance est déjà associée à un autre ingrédient
        $existingIngredient = Ingredient::where('balance_id', $balance_id)
            ->where('id', '!=', $ingredient->id)
            ->first();

        if ($existingIngredient) {
            return response()->json([
                'message' => 'Cette balance est déjà associée à un autre ingrédient',
                'ingredient' => [
                    'id' => $existingIngredient->id,
                    'label' => $existingIngredient->label,
                ]
            ], 422);
        }

        // Associer la balance à l'ingrédient
        $ingredient->balance_id = $balance_id;
        $ingredient->is_connected = true;
        $ingredient->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Balance associée avec succès à l\'ingrédient',
            'data' => [
                'balance' => [
                    'id' => $balance->id,
                    'mac_address' => $balance->mac_address,
                    'name' => $balance->name,
                ],
                'ingredient' => [
                    'id' => $ingredient->id,
                    'label' => $ingredient->label,
                    'quantity' => $ingredient->quantity,
                    'max_quantity' => $ingredient->max_quantity,
                    'mesure' => $ingredient->measure ? $ingredient->measure->name : null,
                ],
            ]
        ], 200);
    }


    /**
     * @group Balances
     * @title Mettre à jour la quantité d'un ingrédient via l'adresse MAC
     * @description Cette route permet de mettre à jour la quantité d'un ingrédient en utilisant l'adresse MAC de la balance associée.
     *
     * @bodyParam mac_address string required L'adresse MAC de la balance. Example: 00:11:22:33:44:55
     * @bodyParam quantity numeric required La nouvelle quantité à définir. Example: 750
     *
     * @response 200 success {
     *  "status": "success",
     *  "message": "Quantité mise à jour avec succès",
     *  "data": {
     *    "id": 3,
     *    "label": "Farine",
     *    "quantity": 750,
     *    "max_quantity": 1000,
     *    "mesure": "Grammes"
     *  }
     * }
     *
     * @response 404 balance_not_found {
     *  "message": "Balance non trouvée avec cette adresse MAC"
     * }
     *
     * @response 404 ingredient_not_found {
     *  "message": "Aucun ingrédient n'est associé à cette balance"
     * }
     *
     * @response 422 validation_error {
     *  "message": "Le champ adresse MAC est obligatoire",
     *  "errors": {
     *    "mac_address": [
     *      "Le champ adresse MAC est obligatoire"
     *    ]
     *  }
     * }
     */
    public function updateQuantityByMac(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'mac_address' => 'required|string',
            'quantity' => 'required|numeric|min:0',
        ], [
            'mac_address.required' => 'Le champ adresse MAC est obligatoire',
            'quantity.required' => 'Le champ quantité est obligatoire',
            'quantity.numeric' => 'La quantité doit être un nombre',
            'quantity.min' => 'La quantité ne peut pas être négative',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        // Recherche de la balance par son adresse MAC
        $balance = Balance::where('mac_address', $request->mac_address)->first();

        if (!$balance) {
            return response()->json([
                'message' => 'Balance non trouvée avec cette adresse MAC'
            ], 404);
        }

        // Mise à jour de la dernière date d'activité de la balance
        $balance->last_update = now();
        $balance->save();

        // Recherche de l'ingrédient lié à cette balance
        $ingredient = Ingredient::where('balance_id', $balance->id)->first();

        if (!$ingredient) {
            return response()->json([
                'message' => 'Aucun ingrédient n\'est associé à cette balance'
            ], 404);
        }

        // Mise à jour de la quantité
        $ingredient->quantity = $request->quantity;
        $ingredient->save();

        $ingredient->load(['type', 'measure']);

        return response()->json([
            'status' => 'success',
            'message' => 'Quantité mise à jour avec succès',
            'data' => new IngredientResource($ingredient)
        ]);
    }
}
