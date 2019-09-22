<?php

namespace Core\Domain\Entity;

final class Action
{
    private $id;

    private $type;

    private $changes;

    private function __construct(string $id, string $type, array $changes = [])
    {
        $this->id = $id;
        $this->type = $type;
        $this->changes = $changes;
    }

    public static function createNewAction(string $id, string $type, array $changes = []): Action
    {
        return new self($id, $type, $changes);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getChanges(): array
    {
        return $this->changes;
    }
}
