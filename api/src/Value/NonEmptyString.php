<?php

namespace App\Value;

class NonEmptyString
{
    protected string $value;

    public function __construct(string $value)
    {
        if ($value === '') {
            throw new \DomainException(sprintf('"%s" is an empty string', $value));
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}