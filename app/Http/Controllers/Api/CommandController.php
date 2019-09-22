<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\Domain\Service\RollbackCommandsServiceInterface;
use App\Service\{
    RollbackCommandFacade,
    CommandHandler
};
use Core\Domain\Command\{
    GenerateShapesCommand,
    ChangeColorCommand
};
use Core\Infrastructure\Persistence\Action as EloquentAction;
use App\Http\Requests\Api\RollbackCommandsRequest;

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

    public function rollbackAction(EloquentAction $eloquentAction, RollbackCommandFacade $service)
    {
        $service->rollbackCommand($eloquentAction);
        return response()->json();
    }

    public function rollbackByLimit(RollbackCommandsRequest $request, RollbackCommandsServiceInterface $service)
    {
        $limit = $request->get('limit');
        $service->rollbackCommands($limit);
        return response()->json();
    }
}
