<?php

namespace src\Infrastructure\Repository\ToDoRepository;

use src\Domain\ToDo\Model\ToDo;
use src\Infrastructure\Exceptions\ToDo\ToDoNotFoundException;
use src\Infrastructure\Repository\BaseRepository\BaseRepository;

class ToDoRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return ToDo::class;
    }

    public function findOneByIdOrFail(string $id): ToDo
    {
        if (null === $todo = $this->objectRepository->find($id)) {
            throw ToDoNotFoundException::fromId($id);
        }

        return $todo;
    }
}