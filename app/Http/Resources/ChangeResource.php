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

        if ($state = $change->getState()) {
            $state = StateResource::make($state);
        } else {
            $state = null;
        }

        if ($previousState = $change->getPreviousState()) {
            $previousState = StateResource::make($previousState);
        } else {
            $previousState = null;
        }

        return compact('state', 'previousState');
    }
}
