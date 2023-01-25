<?php

namespace src\Application\Service\User;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Component\HttpFoundation\Request;
use src\Application\Service\Request\RequestService;
use src\Domain\ToDo\Model\ToDo;
use src\Domain\User\Model\User;
use src\Infrastructure\Repository\ToDoRepository\ToDoRepository;

class UserAddToDoService
{
    private ToDoRepository $toDoRepository;

    public function __construct(ToDoRepository $toDoRepository)
    {
        $this->toDoRepository = $toDoRepository;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function addToDo(Request $request)
    {
        $name = RequestService::getField($request,'name');
        $description = RequestService::getField($request, 'description');

        $todo = new ToDo($name, $description);

        $this->toDoRepository->save($todo);
        return $todo;

    }
}