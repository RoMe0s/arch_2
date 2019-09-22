<?php

namespace Core\Infrastructure\Repository;

use Core\Domain\Entity\Shape;
use Core\Domain\Repository\ShapeRepositoryInterface;
use Core\Infrastructure\Mapper\ShapeMapper;
use Core\Infrastructure\Persistence\Shape as EloquentShape;

class ShapeRepository implements ShapeRepositoryInterface
{
    private $shapeMapper;

    public function __construct(ShapeMapper $shapeMapper)
    {
        $this->shapeMapper = $shapeMapper;
    }

    public function all(): array
    {
        $shapes = [];
        $eloquentShapes = EloquentShape::latest()->get();
        foreach ($eloquentShapes as $eloquentShape) {
            $shapes[] = $this->shapeMapper->map($eloquentShape);
        }
        return $shapes;
    }

    public function findById(string $id): ?Shape
    {
        $eloquentShape = EloquentShape::find($id);
        if ($eloquentShape) {
            return $this->shapeMapper->map($eloquentShape);
        }
        return null;
    }

    public function findByRand(): ?Shape
    {
        $eloquentShape = EloquentShape::inRandomOrder()->first();
        if ($eloquentShape) {
            return $this->shapeMapper->map($eloquentShape);
        }
        return null;
    }

    public function save(Shape $shape): void
    {
        EloquentShape::updateOrCreate(['id' => $shape->getId()], [
            'type' => $shape->getType()->getValue(),
            'color' => $shape->getColor()->getValue()
        ]);
    }

    public function delete(Shape $shape): void
    {
        EloquentShape::where('id', $shape->getId())->delete();
    }
}
