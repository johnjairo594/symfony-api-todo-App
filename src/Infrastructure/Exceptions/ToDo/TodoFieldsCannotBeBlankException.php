<?php

namespace App\Infrastructure\Exceptions\ToDo;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TodoFieldsCannotBeBlankException extends BadRequestHttpException
{
    public static function nameBlank(): self
    {
        throw new self('Name field cannot be blank');
    }

    public static function descriptionBlank(): self
    {
        throw new self('Description field cannot be blank');
    }
}