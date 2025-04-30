<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * @group Types
     * @title Récupérer tous les types d'ingrédients
     * @description Cette route permet de récupérer la liste de tous les types d'ingrédients disponibles.
     *
     * @response 200 success {
     *  "status": "success",
     *  "data": [
     *    {
     *      "id": 1,
     *      "name": "Légumes"
     *    },
     *    {
     *      "id": 2,
     *      "name": "Viandes"
     *    },
     *    {
     *      "id": 3,
     *      "name": "Fruits"
     *    }
     *  ]
     * }
     */
    public function index()
    {
        $types = Type::select('id', 'name')->get();

        return response()->json([
            'status' => 'success',
            'data' => $types
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
