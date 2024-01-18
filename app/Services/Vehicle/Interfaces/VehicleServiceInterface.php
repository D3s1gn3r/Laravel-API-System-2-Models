<?php

namespace App\Services\Vehicle\Interfaces;

use App\DTO\Response\ResponseDTO;
use App\DTO\Vehicle\VehicleDTO;

interface VehicleServiceInterface
{

    public function getAvailableVehicles(int $loggedUserId): ResponseDTO;

    public function storeVehicle(int $loggedUserId, VehicleDTO $data): ResponseDTO;

    public function getVehicleById(int $loggedUserId, int $vehicleId): ResponseDTO;

    public function updateVehicleById(int $loggedUserId, int $vehicleId, VehicleDTO $data): ResponseDTO;

    public function deleteVehicleById(int $loggedUserId, int $vehicleId): ResponseDTO;
}
