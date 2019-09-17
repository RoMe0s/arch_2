<?php

namespace App\Http\Resources;

use Core\Domain\Entity\State;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource
{
    public function toArray($request)
    {
        /** @var State $state */
        $state = $this->resource;

        return [
            'type' => $state->getType()->getValue(),
            'color' => $state->getColor()->getValue()
        ];
    }
}
