<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Flight;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('flight')->get();
        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'flight_id' => 'required|exists:flights,id',
            'passenger_count' => 'required|integer|min:1|max:10',
            'passenger_details' => 'required|array',
            'passenger_details.*.name' => 'required|string',
            'passenger_details.*.age' => 'required|integer|min:1|max:120',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $flight = Flight::findOrFail($request->flight_id);

        if ($flight->available_seats < $request->passenger_count) {
            return response()->json(['error' => 'Not enough available seats'], 400);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $request->flight_id,
            'passenger_count' => $request->passenger_count,
            'total_price' => $flight->price * $request->passenger_count,
            'passenger_details' => $request->passenger_details,
        ]);

        // Update available seats
        $flight->decrement('available_seats', $request->passenger_count);

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->with('flight')
            ->findOrFail($id);
            
        return response()->json($booking);
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
