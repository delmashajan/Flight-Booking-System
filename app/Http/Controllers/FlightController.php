<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'origin' => 'required|string|size:3',
            'destination' => 'required|string|size:3',
            'departure_date' => 'required|date',
            'passenger_count' => 'required|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $departureDate = $request->departure_date;

        $flights = Flight::where('origin', $request->origin)
            ->where('destination', $request->destination)
            ->where('available_seats', '>=', $request->passenger_count)
            ->whereDate('departure', $departureDate)
            ->get();

        if ($flights->isEmpty()) {
            return response()->json(['message' => 'No flights found'], 404);
        }

        return response()->json($flights);
    }
    public function index()
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
