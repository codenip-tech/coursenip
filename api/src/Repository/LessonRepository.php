<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Lesson;

class LessonRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Lesson::class;
    }
}
