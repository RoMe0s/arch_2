<?php

namespace App\Service;

use Core\Domain\Command\UndoCommand;
use Core\Infrastructure\Mapper\ActionMapper;
use Core\Infrastructure\Persistence\Action as EloquentAction;

class UndoCommandFacade
{
    private $actionMapper;

    private $undoCommand;

    public function __construct(ActionMapper $actionMapper, UndoCommand $undoCommand)
    {
        $this->actionMapper = $actionMapper;
        $this->undoCommand = $undoCommand;
    }

    public function undoCommand(EloquentAction $eloquentAction)
    {
        $action = $this->actionMapper->map($eloquentAction);
        $this->undoCommand->setAction($action);
        CommandHandler::handle($this->undoCommand);
    }
}
