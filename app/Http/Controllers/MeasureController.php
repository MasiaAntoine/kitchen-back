<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeasureController extends Controller
{

    /**
     * @group Mesures
     * @title Récupérer toutes les unités de mesure
     * @description Cette route permet de récupérer la liste de toutes les unités de mesure disponibles.
     *
     * @response 200 success {
     *  "status": "success",
     *  "data": [
     *    {
     *      "id": 1,
     *      "name": "Grammes",
     *      "symbol": "g"
     *    },
     *    {
     *      "id": 2,
     *      "name": "Millilitres",
     *      "symbol": "ml"
     *    },
     *    {
     *      "id": 3,
     *      "name": "Unités",
     *      "symbol": "u"
     *    }
     *  ]
     * }
     */
    public function index(): JsonResponse
    {
        $measures = Measure::select('id', 'name', 'symbol')->get();

        return response()->json([
            'status' => 'success',
            'data' => $measures
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
