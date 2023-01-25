<?php

namespace src\Infrastructure\Repository\ToDoRepository;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
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

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(ToDo $toDo): void
    {
        $this->saveEntity($toDo);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function remove(ToDo $toDo): void
    {
        $this->removeEntity($toDo);
    }
}