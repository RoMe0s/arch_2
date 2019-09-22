<?php

namespace App\Http\Resources;

use Core\Domain\Entity\Change;
use Illuminate\Http\Resources\Json\JsonResource;

class ChangeResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Change $change */
        $change = $this->resource;

        return [
            'type' => $change->getType()->getValue(),
            'color' => $change->getColor()->getValue()
        ];
    }
}
