<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
