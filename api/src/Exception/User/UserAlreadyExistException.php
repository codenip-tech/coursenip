<?php

declare(strict_types=1);

namespace App\Exception\User;

use App\Value\Email;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UserAlreadyExistException extends ConflictHttpException
{
    private const MESSAGE = 'User with email %s already exist';

    public static function fromEmail(Email $email): self
    {
        throw new self(\sprintf(self::MESSAGE, $email->getValue()));
    }
}
