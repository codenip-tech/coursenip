<?php

declare(strict_types=1);

namespace App\Security\Authorization\Voter;

use App\Entity\Lesson;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class LessonVoter extends Voter implements VoterBase
{
    public const LESSON_LIST = 'LESSON_LIST';
    public const LESSON_READ = 'LESSON_READ';
    public const LESSON_CREATE = 'LESSON_CREATE';
    public const LESSON_UPDATE = 'LESSON_UPDATE';
    public const LESSON_DELETE = 'LESSON_DELETE';

    protected function supports(string $attribute, $subject)
    {
        return \in_array($attribute, $this->supportedAttributes(), true);
    }

    /**
     * @param Lesson|null $subject
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
            self::LESSON_LIST,
            self::LESSON_READ,
            self::LESSON_CREATE,
            self::LESSON_UPDATE,
            self::LESSON_DELETE,
        ];
    }
}
