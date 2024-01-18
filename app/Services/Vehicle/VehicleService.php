<?php

namespace App\Services\Vehicle;

use App\DTO\Response\ResponseDTO;
use App\DTO\Vehicle\VehicleDTO;
use App\Models\User;
use App\Repositories\Vehicle\Interfaces\VehicleRepositoryInterface;
use App\Services\Permission\Interfaces\PermissionsServiceInterface;
use App\Services\Vehicle\Interfaces\VehicleServiceInterface;

class VehicleService implements VehicleServiceInterface
{
    public function __construct(
        private PermissionsServiceInterface $permissionService,
        private VehicleRepositoryInterface $repository
    ){}

    public function getAvailableVehicles(int $loggedUserId): ResponseDTO
    {
        if($this->permissionService->can(User::VEHICLE_ACCESS)){
            return new ResponseDTO($this->repository->retrieveAllVehicles()->toArray());
        }
        else{
            return new ResponseDTO([$this->repository->retrieveVehiclesRelatedToLoggedUser($loggedUserId)->toArray()]);
        }
    }

    public function storeVehicle(int $loggedUserId, VehicleDTO $data): ResponseDTO
    {
        if($this->repository->createVehicle($loggedUserId, $data)){
            return new ResponseDTO(["message" => "Success."]);
        }
        else{
            return new ResponseDTO(["message" => "Unexpected error."], 500);
        }
    }

    public function getVehicleById(int $loggedUserId, int $vehicleId): ResponseDTO
    {
        $vehicle = $this->repository->retrieveVehicleById($vehicleId);
        if(!$this->permissionService->can(User::VEHICLE_ACCESS) &&
            $vehicle->user_id != $loggedUserId)
        {
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }
        else{
            return new ResponseDTO($vehicle->toArray());
        }
    }

    public function updateVehicleById(int $loggedUserId, int $vehicleId, VehicleDTO $data): ResponseDTO
    {
        $vehicle = $this->repository->retrieveVehicleById($vehicleId);
        if(!$this->permissionService->can(User::VEHICLE_ACCESS) &&
            $vehicle->user_id != $loggedUserId)
        {
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }
        else{
            if($this->repository->updateVehicleById($vehicleId, $data)){
                return new ResponseDTO(["message" => "Success."]);
            }
            else{
                return new ResponseDTO(["message" => "Unexpected error."], 500);
            }
        }
    }

    public function deleteVehicleById(int $loggedUserId, int $vehicleId): ResponseDTO
    {
        $vehicle = $this->repository->retrieveVehicleById($vehicleId);
        if(!$this->permissionService->can(User::VEHICLE_ACCESS) &&
            $vehicle->user_id != $loggedUserId)
        {
            return new ResponseDTO(["message" => "Unauthenticated."], 401);
        }
        else{
            if($this->repository->removeVehicle($vehicleId)){
                return new ResponseDTO(["message" => "Success."]);
            }
            else{
                return new ResponseDTO(["message" => "Unexpected error."], 500);
            }
        }
    }
}
