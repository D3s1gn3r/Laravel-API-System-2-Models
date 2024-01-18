<?php

namespace App\Repositories\Vehicle;

use App\DTO\Vehicle\VehicleDTO;
use App\Models\Vehicle;
use App\Repositories\Vehicle\Interfaces\VehicleRepositoryInterface;
use Illuminate\Support\Collection;

class VehicleRepository implements VehicleRepositoryInterface
{

    public function retrieveAllVehicles(): Collection
    {
        return Vehicle::with('user')->get();
    }

    public function retrieveVehiclesRelatedToLoggedUser(int $userId): Collection
    {

        return Vehicle::with('user')->where('user_id', $userId)->get();
    }

    public function retrieveVehicleById(int $vehicleId): Vehicle
    {
        return Vehicle::with('user')->where('id', $vehicleId)->first();
    }

    public function createVehicle(int $loggedUserId, VehicleDTO $data): bool
    {
        $vehicle = new Vehicle();
        $vehicle->user_id = $loggedUserId;
        foreach ($data->toArray() as $key => $value){
            $vehicle->{$key} = $value;
        }
        return $vehicle->save();
    }

    public function updateVehicleById(int $vehicleId, VehicleDTO $data): bool
    {
        $vehicle = Vehicle::where('id', $vehicleId)->firstOrFail();
        foreach ($data->toArray() as $key => $value){
            $vehicle->{$key} = $value;
        }
        return $vehicle->save();
    }

    public function removeVehicle(int $vehicleId): bool
    {
        return Vehicle::where('id', $vehicleId)->delete();
    }
}
