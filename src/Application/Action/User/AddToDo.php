<?php

namespace src\Application\Action\User;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use src\Application\Service\Request\RequestService;
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
        $name = RequestService::getField($request,'name');
        $description = RequestService::getField($request, 'description');

        return $this->userAddToDoService->addToDo($name, $description);
    }
}