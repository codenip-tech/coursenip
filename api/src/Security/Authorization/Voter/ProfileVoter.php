<?php

declare(strict_types=1);

namespace App\Security\Authorization\Voter;

use App\Entity\Profile;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ProfileVoter extends Voter implements VoterBase
{
    public const PROFILE_LIST = 'PROFILE_LIST';
    public const PROFILE_READ = 'PROFILE_READ';
    public const PROFILE_CREATE = 'PROFILE_CREATE';
    public const PROFILE_UPDATE = 'PROFILE_UPDATE';
    public const PROFILE_DELETE = 'PROFILE_DELETE';

    protected function supports(string $attribute, $subject)
    {
        return \in_array($attribute, $this->supportedAttributes(), true);
    }

    /**
     * @param Profile|null $subject
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        if (self::PROFILE_LIST === $attribute) {
            return true;
        }

        if (self::PROFILE_READ === $attribute) {
            return true;
        }

        if (self::PROFILE_CREATE === $attribute) {
            return true;
        }

        if (\in_array($attribute, [self::PROFILE_UPDATE, self::PROFILE_DELETE], true)) {
            return $subject->belongsTo($token->getUser());
        }

        return false;
    }

    public function supportedAttributes(): array
    {
        return [
            self::PROFILE_LIST,
            self::PROFILE_READ,
            self::PROFILE_CREATE,
            self::PROFILE_UPDATE,
            self::PROFILE_DELETE,
        ];
    }
}
