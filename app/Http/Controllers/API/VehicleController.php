<?php

namespace App\Http\Controllers\API;

use App\DTO\Vehicle\VehicleDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Vehicle;
use App\Services\Vehicle\Interfaces\VehicleServiceInterface;

class VehicleController extends Controller
{

    public function __construct(
        private VehicleServiceInterface $service
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->service->getAvailableVehicles(request()->user()->id);
        return response()->json($response->data, $response->code);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $response = $this->service->storeVehicle(
            request()->user()->id,
            VehicleDTO::create($request->validated())
        );
        return response()->json($response->data, $response->code);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        $response = $this->service->getVehicleById(
            request()->user()->id,
            $vehicle->id
        );
        return response()->json($response->data, $response->code);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $response = $this->service->updateVehicleById(
            request()->user()->id,
            $vehicle->id,
            VehicleDTO::create($request->validated())
        );
        return response()->json($response->data, $response->code);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $response = $this->service->deleteVehicleById(
            request()->user()->id,
            $vehicle->id
        );
        return response()->json($response->data, $response->code);
    }
}
