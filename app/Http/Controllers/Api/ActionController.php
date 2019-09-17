<?php

namespace App\Http\Controllers\Api;

use Core\Infrastructure\Service\ActionService;

class ActionController
{
    public function index(ActionService $actionService)
    {
        $actions = $actionService->get();
    }
}
