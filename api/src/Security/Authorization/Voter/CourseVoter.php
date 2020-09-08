<?php

declare(strict_types=1);

namespace App\Security\Authorization\Voter;

use App\Entity\Course;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CourseVoter extends Voter implements VoterBase
{
    public const COURSE_LIST = 'COURSE_LIST';
    public const COURSE_READ = 'COURSE_READ';
    public const COURSE_CREATE = 'COURSE_CREATE';
    public const COURSE_UPDATE = 'COURSE_UPDATE';
    public const COURSE_DELETE = 'COURSE_DELETE';

    protected function supports(string $attribute, $subject)
    {
        return \in_array($attribute, $this->supportedAttributes(), true);
    }

    /**
     * @param Course|null $subject
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        if (self::COURSE_LIST === $attribute) {
            return true;
        }

        if (self::COURSE_READ === $attribute) {
            return true;
        }

        if (self::COURSE_CREATE === $attribute) {
            return true;
        }

        if (\in_array($attribute, [self::COURSE_UPDATE, self::COURSE_DELETE], true)) {
            return $subject->belongsTo($token->getUser());
        }

        return false;
    }

    public function supportedAttributes(): array
    {
        return [
            self::COURSE_LIST,
            self::COURSE_READ,
            self::COURSE_CREATE,
            self::COURSE_UPDATE,
            self::COURSE_DELETE,
        ];
    }
}
