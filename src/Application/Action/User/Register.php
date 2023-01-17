<?php

namespace src\Application\Action\User;

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
        return $this->userRegisterService->create($request);
    }
}