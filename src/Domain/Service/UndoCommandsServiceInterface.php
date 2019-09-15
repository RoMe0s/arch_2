<?php

namespace Core\Domain\Service;

interface UndoCommandsServiceInterface
{
    public function execute(int $limit): void;
}