<?php

declare(strict_types=1);

namespace App\Messenger\Message;

use App\Value\Email;
use App\Value\NonEmptyString;

class UserRegisteredMessage
{
    private string $id;
    private string $name;
    private string $email;
    private string $token;

    public function __construct(string $id, NonEmptyString $name, Email $email, string $token)
    {
        $this->id = $id;
        $this->name = $name->getValue();
        $this->email = $email->getValue();
        $this->token = $token;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
