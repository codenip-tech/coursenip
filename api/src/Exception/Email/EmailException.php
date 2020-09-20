<?php

declare(strict_types=1);

namespace App\Exception\Email;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class EmailException extends ConflictHttpException
{
    private const MESSAGE = 'Invalid email "%s"';

    public static function invalidEmail(string $email): self
    {
        throw new self(\sprintf(self::MESSAGE, $email));
    }
}
