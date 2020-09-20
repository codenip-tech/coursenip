<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Course;

class CourseRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Course::class;
    }
}
