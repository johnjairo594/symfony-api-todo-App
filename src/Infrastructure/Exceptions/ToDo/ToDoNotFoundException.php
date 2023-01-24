<?php

namespace src\Infrastructure\Exceptions\ToDo;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ToDoNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'To Do with id %s not found';

    public static function fromId(string $id): self
    {
        throw new self(sprintf(self::MESSAGE, $id));
    }
}