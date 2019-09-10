<?php

namespace Core\Domain\Command;

use Core\Domain\Exception\NoShapesException;
use Core\Domain\Repository\ShapeRepositoryInterface;

final class ChangeColorCommand implements CommandInterface
{
    private $shapeRepository;

    public function __construct(ShapeRepositoryInterface $shapeRepository)
    {
        $this->shapeRepository = $shapeRepository;
    }

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
