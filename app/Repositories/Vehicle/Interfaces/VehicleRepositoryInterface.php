<?php

namespace App\Repositories\Vehicle\Interfaces;

use App\DTO\Vehicle\VehicleDTO;
use App\Models\Vehicle;
use Illuminate\Support\Collection;

interface VehicleRepositoryInterface
{

    public function retrieveAllVehicles(): Collection;

    public function retrieveVehiclesRelatedToLoggedUser(int $userId): Collection;

    public function retrieveVehicleById(int $vehicleId): Vehicle;

    public function createVehicle(int $loggedUserId, VehicleDTO $data): bool;

    public function updateVehicleById(int $vehicleId, VehicleDTO $data): bool;

    public function removeVehicle(int $vehicleId): bool;
}
