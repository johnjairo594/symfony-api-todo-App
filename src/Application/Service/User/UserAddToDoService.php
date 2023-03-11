<?php

namespace src\Application\Service\User;

use App\Infrastructure\Exceptions\ToDo\TodoFieldsCannotBeBlankException;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use src\Infrastructure\Repository\UserRepository\UserRepository;
use src\Domain\ToDo\Model\ToDo;
use src\Infrastructure\Repository\ToDoRepository\ToDoRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserAddToDoService
{
    private ToDoRepository $toDoRepository;
    private TokenStorageInterface $tokenStorage;
    private JWTTokenManagerInterface $tokenManager;
    private UserRepository $userRepository;

    public function __construct(ToDoRepository $toDoRepository,
                                UserRepository $userRepository,
                                TokenStorageInterface $tokenStorage,
                                JWTTokenManagerInterface $tokenManager)
    {
        $this->toDoRepository = $toDoRepository;
        $this->tokenStorage = $tokenStorage;
        $this->tokenManager = $tokenManager;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws JWTDecodeFailureException
     */
    public function addToDo(string $name, string $description): ToDo
    {
        $decodedJwtToken = $this->tokenManager->decode($this->tokenStorage->getToken());
        $ownerId = $decodedJwtToken['id'];
        $owner = $this->userRepository->FindOneByIdOrFail($ownerId);
        if (trim($name) === ''){
            throw TodoFieldsCannotBeBlankException::nameBlank();
        }
        if (trim($description) === ''){
            throw TodoFieldsCannotBeBlankException::descriptionBlank();
        }
        $todo = new ToDo($name, $description);
        $todo->setOwner($owner);
        $this->toDoRepository->save($todo);

        $owner->addToDoToCollection($todo);

        return $todo;
    }
}