<?php

namespace App\Value;

class Email extends NonEmptyString
{
    public function __construct(string $value)
    {
        if (!\filter_var($value, \FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException('Invalid email');
        }
        parent::__construct($value);
    }
}