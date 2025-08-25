<?php

namespace App\Http\Controllers;

use App\Http\Resources\IngredientResource;
use App\Models\ConnectedScale;
use App\Models\Ingredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConnectedScaleController extends Controller
{
    /**
     * @group ConnectedScales
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
        $connectedScales = ConnectedScale::select('id', 'mac_address', 'name')
            ->get()
            ->map(function ($connectedScale) {
                return [
                    'id' => $connectedScale->id,
                    'mac_address' => $connectedScale->mac_address,
                    'name' => $connectedScale->name,
                    'is_online' => $connectedScale->isOnline(),
                ];
            });

        return response()->json($connectedScales);
    }

    /**
     * @group ConnectedScales
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
            'mac_address' => 'required|string|unique:connected_scales,mac_address',
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

        $connectedScale = ConnectedScale::create([
            'mac_address' => $request->mac_address,
            'name' => $request->name,
            'last_update' => now(),
        ]);

        return response()->json([
            'data' => [
                'id' => $connectedScale->id,
                'mac_address' => $connectedScale->mac_address,
                'name' => $connectedScale->name,
                'is_online' => true,
                'last_update' => $connectedScale->last_update,
            ],
            'message' => 'Balance créée avec succès'
        ], 201);
    }


    /**
     * @group ConnectedScales
     * @title Associer une balance à un ingrédient
     * @description Cette route permet d'associer une balance existante à un ingrédient existant.
     * Une balance ne peut être associée qu'à un seul ingrédient à la fois.
     *
     * @urlParam connected_scale_id required L'identifiant de la balance à associer. Example: 1
     * @bodyParam ingredient_id integer required L'identifiant de l'ingrédient à associer à la balance. Example: 3
     *
     * @response 200 success {
     *  "status": "success",
     *  "message": "Balance associée avec succès à l'ingrédient",
     *  "data": {
     *    "connected_scale": {
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
    public function associateWithIngredient(Request $request, $connected_scale_id): JsonResponse
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
        $connectedScale = ConnectedScale::find($connected_scale_id);
        $ingredient = Ingredient::find($request->ingredient_id);

        if (!$connectedScale || !$ingredient) {
            return response()->json(['message' => 'Balance ou ingrédient non trouvé'], 404);
        }

        // Vérifier si la balance est déjà associée à un autre ingrédient
        $existingIngredient = Ingredient::where('connected_scale_id', $connected_scale_id)
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
        $ingredient->connected_scale_id = $connected_scale_id;
        $ingredient->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Balance associée avec succès à l\'ingrédient',
            'data' => [
                'connected_scale' => [
                    'id' => $connectedScale->id,
                    'mac_address' => $connectedScale->mac_address,
                    'name' => $connectedScale->name,
                ],
                'ingredient' => [
                    'id' => $ingredient->id,
                    'label' => $ingredient->label,
                    'quantity' => $ingredient->quantity,
                    'max_quantity' => $ingredient->max_quantity,
                    'mesure' => $ingredient->measurementUnit ? $ingredient->measurementUnit->name : null,
                ],
            ]
        ], 200);
    }


    /**
     * @group ConnectedScales
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
        $connectedScale = ConnectedScale::where('mac_address', $request->mac_address)->first();

        if (!$connectedScale) {
            return response()->json([
                'message' => 'Balance non trouvée avec cette adresse MAC'
            ], 404);
        }

        // Mise à jour de la dernière date d'activité de la balance
        $connectedScale->last_update = now();
        $connectedScale->save();

        // Recherche de l'ingrédient lié à cette balance
        $ingredient = Ingredient::where('connected_scale_id', $connectedScale->id)->first();

        if (!$ingredient) {
            return response()->json([
                'message' => 'Aucun ingrédient n\'est associé à cette balance'
            ], 404);
        }

        // Mise à jour de la quantité
        $ingredient->quantity = $request->quantity;
        $ingredient->save();

        $ingredient->load(['placeType', 'measurementUnit']);

        return response()->json([
            'status' => 'success',
            'message' => 'Quantité mise à jour avec succès',
            'data' => new IngredientResource($ingredient)
        ]);
    }


    /**
     * @group ConnectedScales
     * @title Supprimer une balance par adresse MAC
     * @description Cette route permet de supprimer une balance en utilisant son adresse MAC. Les ingrédients associés à cette balance seront déconnectés.
     *
     * @bodyParam mac_address string required L'adresse MAC de la balance à supprimer. Example: 00:11:22:33:44:55
     *
     * @response 200 success {
     *  "status": "success",
     *  "message": "Balance supprimée avec succès",
     *  "data": {
     *    "mac_address": "00:11:22:33:44:55",
     *    "name": "Balance cuisine"
     *  }
     * }
     *
     * @response 404 balance_not_found {
     *  "message": "Balance non trouvée avec cette adresse MAC"
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
    public function destroyByMac(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'mac_address' => 'required|string',
        ], [
            'mac_address.required' => 'Le champ adresse MAC est obligatoire',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        // Recherche de la balance par son adresse MAC
        $connectedScale = ConnectedScale::where('mac_address', $request->mac_address)->first();

        if (!$connectedScale) {
            return response()->json([
                'message' => 'Balance non trouvée avec cette adresse MAC'
            ], 404);
        }

        // Récupérer les informations de la balance avant de la supprimer
        $connectedScaleData = [
            'mac_address' => $connectedScale->mac_address,
            'name' => $connectedScale->name
        ];

        // Déconnecter tous les ingrédients associés à cette balance
        Ingredient::where('connected_scale_id', $connectedScale->id)
            ->update([
                'connected_scale_id' => null,
            ]);

        // Supprimer la balance
        $connectedScale->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Balance supprimée avec succès',
            'data' => $connectedScaleData
        ]);
    }
}
