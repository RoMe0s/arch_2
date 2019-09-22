<?php

namespace App\Service;

use Core\Domain\Service\RollbackCommandService;
use Core\Infrastructure\Mapper\ActionMapper;
use Core\Infrastructure\Persistence\Action as EloquentAction;
use Illuminate\Support\Facades\DB;

class RollbackCommandFacade
{
    private $actionMapper;

    private $rollbackCommandService;

    public function __construct(
        ActionMapper $actionMapper,
        RollbackCommandService $rollbackCommandService
    ) {
        $this->actionMapper = $actionMapper;
        $this->rollbackCommandService = $rollbackCommandService;
    }

    public function rollbackCommand(EloquentAction $eloquentAction): void
    {
        $action = $this->actionMapper->map($eloquentAction);

        DB::transaction(function () use ($action) {
            $this->rollbackCommandService->rollback($action);
        });
    }
}
