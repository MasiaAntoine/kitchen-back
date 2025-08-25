<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlaceType;

class PlaceTypeController extends Controller
{
    /**
     * @group PlaceTypes
     * @title Récupérer tous les types de lieux
     * @description Cette route permet de récupérer la liste de tous les types de lieux disponibles.
     *
     * @response 200 success {
     *  "status": "success",
     *  "data": [
     *    {
     *      "id": 1,
     *      "name": "Placard"
     *    },
     *    {
     *      "id": 2,
     *      "name": "Frigo"
     *    },
     *    {
     *      "id": 3,
     *      "name": "Congélateur"
     *    }
     *  ]
     * }
     */
    public function index()
    {
        $placeTypes = PlaceType::select('id', 'name')->get();

        return response()->json([
            'status' => 'success',
            'data' => $placeTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
