<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckVoucherRequest;
use App\Http\Requests\GenerateVoucherRequest;
use App\Http\Resources\VoucherResource;
use App\Models\Voucher;
use App\Services\SeatGeneratorService;

class VoucherController extends Controller
{
    public function check(CheckVoucherRequest $request)
    {
        $exists = Voucher::where('flight_number', $request->flightNumber)
            ->whereDate('flight_date', $request->date)
            ->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    public function generate(
        GenerateVoucherRequest $request,
        SeatGeneratorService $seatGenerator
    ) {

        $exists = Voucher::where('flight_number', $request->flightNumber)
            ->whereDate('flight_date', $request->date)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher already generated for this flight.'
            ], 409);
        }

        $seats = $seatGenerator->generate($request->aircraft);

        try {
            $voucher = Voucher::create([
                'crew_name' => $request->name,
                'crew_id' => $request->id,
                'flight_number' => $request->flightNumber,
                'flight_date' => $request->date,
                'aircraft_type' => $request->aircraft,
                'seat1' => $seats[0],
                'seat2' => $seats[1],
                'seat3' => $seats[2],
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Voucher already exists.'
            ], 409);
        }
        return new VoucherResource($voucher);
    }
}
