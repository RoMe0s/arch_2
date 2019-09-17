<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\{
    UndoCommandFacade,
    CommandHandler
};
use Core\Domain\Command\{
    GenerateShapesCommand,
    ChangeColorCommand
};
use Core\Infrastructure\Persistence\Action as EloquentAction;
use Core\Infrastructure\Service\UndoCommandsService;
use App\Http\Requests\Api\UndoCommandsRequest;

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

    public function undoAction(EloquentAction $eloquentAction, UndoCommandFacade $undoCommandFacade)
    {
        $undoCommandFacade->undoCommand($eloquentAction);
        return response()->json();
    }

    public function undoByLimit(UndoCommandsRequest $request, UndoCommandsService $service)
    {
        $limit = $request->get('limit');
        $service->execute($limit);
        return response()->json();
    }
}
