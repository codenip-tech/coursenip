<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Skill;

class SkillRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Skill::class;
    }
}
