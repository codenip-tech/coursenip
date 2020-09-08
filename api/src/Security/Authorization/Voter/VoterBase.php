<?php

declare(strict_types=1);

namespace App\Security\Authorization\Voter;

interface VoterBase
{
    public function supportedAttributes(): array;
}
