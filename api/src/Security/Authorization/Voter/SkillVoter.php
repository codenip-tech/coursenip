<?php

declare(strict_types=1);

namespace App\Security\Authorization\Voter;

use App\Entity\Skill;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class SkillVoter extends Voter implements VoterBase
{
    public const SKILL_LIST = 'SKILL_LIST';
    public const SKILL_READ = 'SKILL_READ';
    public const SKILL_CREATE = 'SKILL_CREATE';
    public const SKILL_UPDATE = 'SKILL_UPDATE';
    public const SKILL_DELETE = 'SKILL_DELETE';

    protected function supports(string $attribute, $subject)
    {
        return \in_array($attribute, $this->supportedAttributes(), true);
    }

    /**
     * @param Skill|null $subject
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        if (\in_array($attribute, $this->supportedAttributes(), true)) {
            return true;
        }

        return false;
    }

    public function supportedAttributes(): array
    {
        return [
            self::SKILL_LIST,
            self::SKILL_READ,
            self::SKILL_CREATE,
            self::SKILL_UPDATE,
            self::SKILL_DELETE,
        ];
    }
}
