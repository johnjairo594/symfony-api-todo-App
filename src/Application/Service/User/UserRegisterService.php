<?php

namespace src\Application\Service\User;

use src\Application\Service\Password\HasherService;
use src\Domain\User\Model\User;
use src\Infrastructure\Exceptions\User\UserAlreadyExistException;
use src\Infrastructure\Repository\UserRepository\UserRepository;

class UserRegisterService
{
    private UserRepository $userRepository;
    private HasherService $hasherService;

    public function __construct(UserRepository $userRepository, HasherService $hasherService)
    {
        $this->userRepository = $userRepository;
        $this->hasherService = $hasherService;
    }

    public function create(string $name, string $email, string $password): User
    {
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