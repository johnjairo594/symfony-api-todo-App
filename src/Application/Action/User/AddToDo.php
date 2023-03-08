<?php

namespace src\Application\Action\User;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use src\Application\Service\User\UserAddToDoService;
use src\Domain\ToDo\Model\ToDo;
use Symfony\Component\HttpFoundation\Request;

class AddToDo
{
    private UserAddToDoService $userAddToDoService;

    public function __construct(UserAddToDoService $userAddToDoService)
    {
        $this->userAddToDoService = $userAddToDoService;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws JWTDecodeFailureException
     */
    public function __invoke(Request $request) : ToDo
    {
        return $this->userAddToDoService->addToDo($request);
    }
}