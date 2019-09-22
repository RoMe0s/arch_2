<?php

namespace App\Http\Resources;

use Core\Domain\Entity\Action;
use Illuminate\Http\Resources\Json\JsonResource;

class ActionResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Action $action */
        $action = $this->resource;
        $changes = collect($action->getChanges());

        return [
            'id' => $action->getId(),
            'type' => $action->getType(),
            'changes' => ChangeResource::collection($changes)
        ];
    }
}
