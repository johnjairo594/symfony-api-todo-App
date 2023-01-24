<?php

namespace src\Application\Service\Password;

use src\Domain\User\Model\User;
use src\Infrastructure\Exceptions\Password\PasswordException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class HasherService
{
    private const MINIMUM_LENGTH = 6;
    
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function generateHashedPassword(User $user, string $password)
    {
        if (self::MINIMUM_LENGTH > strlen($password)) {
            throw PasswordException::invalidLength();
        }

        return $this->userPasswordHasher->hashPassword($user, $password);
    }

    public function isValidPassword(User $user, string $oldPassword): bool
    {
        return $this->userPasswordHasher->isPasswordValid($user, $oldPassword);
    }
}