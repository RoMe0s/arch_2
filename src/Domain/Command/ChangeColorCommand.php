<?php

namespace Core\Domain\Command;

use Core\Domain\Exception\NoShapesException;

final class ChangeColorCommand implements CommandInterface
{
    public function execute(): void
    {
        $shape = $this->shapeRepository->findByRand();
        if (!$shape) {
            throw new NoShapesException();
        }
        $shape->toggleColor();
        $this->shapeRepository->save($shape);
    }
}
