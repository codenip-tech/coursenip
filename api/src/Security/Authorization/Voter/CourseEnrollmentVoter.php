<?php

declare(strict_types=1);

namespace App\Security\Authorization\Voter;

use App\Entity\CourseEnrollment;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CourseEnrollmentVoter extends Voter implements VoterBase
{
    public const COURSE_ENROLLMENT_LIST = 'COURSE_ENROLLMENT_LIST';
    public const COURSE_ENROLLMENT_READ = 'COURSE_ENROLLMENT_READ';
    public const COURSE_ENROLLMENT_CREATE = 'COURSE_ENROLLMENT_CREATE';
    public const COURSE_ENROLLMENT_UPDATE = 'COURSE_ENROLLMENT_UPDATE';
    public const COURSE_ENROLLMENT_DELETE = 'COURSE_ENROLLMENT_DELETE';

    protected function supports(string $attribute, $subject)
    {
        return \in_array($attribute, $this->supportedAttributes(), true);
    }

    /**
     * @param CourseEnrollment|null $subject
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        if (self::COURSE_ENROLLMENT_LIST === $attribute) {
            return true;
        }

        if (self::COURSE_ENROLLMENT_READ === $attribute) {
            return true;
        }

        if (self::COURSE_ENROLLMENT_CREATE === $attribute) {
            return true;
        }

        if (\in_array($attribute, [self::COURSE_ENROLLMENT_UPDATE, self::COURSE_ENROLLMENT_DELETE], true)) {
            return $subject->belongsTo($token->getUser());
        }

        return false;
    }

    public function supportedAttributes(): array
    {
        return [
            self::COURSE_ENROLLMENT_LIST,
            self::COURSE_ENROLLMENT_READ,
            self::COURSE_ENROLLMENT_CREATE,
            self::COURSE_ENROLLMENT_UPDATE,
            self::COURSE_ENROLLMENT_DELETE,
        ];
    }
}
