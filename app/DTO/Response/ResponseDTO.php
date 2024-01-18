<?php

namespace App\DTO\Response;

use App\DTO\AbstractDTO;

class ResponseDTO extends AbstractDTO
{
    public function __construct(public array $data, public int $code = 200){}
}
