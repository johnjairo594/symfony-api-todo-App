<?php

namespace src\Application\Service\User;

use src\Application\Service\Password\HasherService;
use src\Application\Service\Request\RequestService;
use src\Domain\User\Model\User;
use src\Infrastructure\Exceptions\User\UserAlreadyExistException;
use src\Infrastructure\Repository\UserRepository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class UserRegisterService
{
    private UserRepository $userRepository;
    private HasherService $hasherService;

    public function __construct(UserRepository $userRepository, HasherService $hasherService)
    {
        $this->userRepository = $userRepository;
        $this->hasherService = $hasherService;
    }

    public function create(Request $request): User
    {
        $name = RequestService::getField($request, 'name');
        $email = RequestService::getField($request, 'email');
        $password = RequestService::getField($request, 'password');

        $user = new User($name, $email);
        $user->setPassword($this->hasherService->generateHashedPassword($user, $password));

        try {
            $this->userRepository->save($user);
        } catch (\Exception $exception) {
            throw UserAlreadyExistException::fromEmail($email);
        }

        return $user;
    }
}