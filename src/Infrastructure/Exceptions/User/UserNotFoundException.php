<?php

namespace src\Infrastructure\Exceptions\User;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'User with email %s not found';

    public static function fromEmail(string $email)
    {
        throw new self(sprintf(self::MESSAGE, $email));
    }

    public static function fromId(string $id)
    {
        throw new self(sprintf('User with id %s not found', $id));
    }
}