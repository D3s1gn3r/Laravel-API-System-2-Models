<?php

namespace App\DTO\Vehicle;

use App\DTO\AbstractDTO;
use App\DTO\Traits\StaticCreateSelfTrait;

class VehicleDTO extends AbstractDTO
{
    use StaticCreateSelfTrait;

    public readonly string $name;
    public readonly string $model;
    public readonly string $vin;

}
