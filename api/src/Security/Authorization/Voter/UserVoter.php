<?php

declare(strict_types=1);

namespace App\Security\Authorization\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter implements VoterBase
{
    public const USER_LIST = 'USER_LIST';
    public const USER_READ = 'USER_READ';
    public const USER_UPDATE = 'USER_UPDATE';
    public const USER_DELETE = 'USER_DELETE';

    protected function supports(string $attribute, $subject): bool
    {
        return \in_array($attribute, $this->supportedAttributes(), true);
    }

    /**
     * @param User|null $subject
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        if (self::USER_LIST === $attribute) {
            return true;
        }

        if (self::USER_READ === $attribute) {
            return true;
        }

        if (\in_array($attribute, [self::USER_UPDATE, self::USER_DELETE], true)) {
            return $subject->equals($token->getUser());
        }

        return false;
    }

    public function supportedAttributes(): array
    {
        return [
            self::USER_LIST,
            self::USER_READ,
            self::USER_UPDATE,
            self::USER_DELETE,
        ];
    }
}
