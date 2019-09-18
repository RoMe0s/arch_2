<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShapeResource;
use Core\Infrastructure\Service\ShapeService;

class ShapeController extends Controller
{
    public function index(ShapeService $shapeService)
    {
        $shapes = collect($shapeService->get());

        return ShapeResource::collection($shapes)->resolve();
    }
}
