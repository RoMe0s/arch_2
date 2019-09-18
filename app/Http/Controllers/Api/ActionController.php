<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ActionResource;
use Core\Infrastructure\Service\ActionService;

class ActionController
{
    public function index(ActionService $actionService)
    {
        $actions = collect($actionService->get());

        return ActionResource::collection($actions)->resolve();
    }
}
