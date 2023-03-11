<?php

namespace src\Application\Action\User;

use src\Application\Service\Request\RequestService;
use src\Application\Service\User\UserRegisterService;
use src\Domain\User\Model\User;
use Symfony\Component\HttpFoundation\Request;

class Register
{
    private UserRegisterService $userRegisterService;

    public function __construct(UserRegisterService $userRegisterService)
    {
        $this->userRegisterService = $userRegisterService;
    }

    public function __invoke(Request $request): User
    {
        $name = RequestService::getField($request, 'name');
        $email = RequestService::getField($request, 'email');
        $password = RequestService::getField($request, 'password');

        return $this->userRegisterService->create($name, $email, $password);
    }
}