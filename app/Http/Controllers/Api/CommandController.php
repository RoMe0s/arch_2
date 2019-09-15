<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Core\Domain\Command\{
    GenerateShapesCommand,
    ChangeColorCommand,
    UndoCommand
};
use Core\Infrastructure\Persistence\Action as EloquentAction;
use Core\Infrastructure\Service\CommandHandler;
use App\Http\Request\Api\UndoCommandsRequest;
use Core\Infrastructure\Service\UndoCommandsService;

class CommandController extends Controller
{
    public function generateShapes(GenerateShapesCommand $command)
    {
        CommandHandler::handle($command);
        return response()->json();
    }

    public function changeColor(ChangeColorCommand $command)
    {
        CommandHandler::handle($command);
        return response()->json();
    }

    public function undoAction(EloquentAction $eloquentAction, UndoCommand $command)
    {
        //TODO: make facade
        $command->setAction($action);
        CommandHandler::handle($command);
        return response()->json();
    }

    public function undoByLimit(UndoCommandsRequest $request, UndoCommandsService $service)
    {
        $limit = $request->get('limit');
        $service->execute($limit);
        return response()->json();
    }
}