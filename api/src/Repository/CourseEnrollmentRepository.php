<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CourseEnrollment;

class CourseEnrollmentRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return CourseEnrollment::class;
    }
}
