<?php

namespace App\Http\Resources;

use Core\Domain\Entity\Shape;
use Illuminate\Http\Resources\Json\JsonResource;

class ShapeResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Shape $shape */
        $shape = $this->resource;

        return [
            'type' => $shape->getType()->getValue(),
            'color' => $shape->getColor()->getValue()
        ];
    }
}
