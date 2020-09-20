<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class CourseEnrollment
{
    private string $id;
    private User $user;
    private Course $course;
    private \DateTime $enrollmentDate;
    private Collection $watchedLessons;

    public function __construct(User $user, Course $course)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->user = $user;
        $this->course = $course;
        $this->enrollmentDate = new \DateTime();
        $this->watchedLessons = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function getEnrollmentDate(): \DateTime
    {
        return $this->enrollmentDate;
    }

    /**
     * @return Collection|Lesson[]
     */
    public function getWatchedLessons(): Collection
    {
        return $this->watchedLessons;
    }

    public function addWatchedLesson(Lesson $lesson): void
    {
        $this->watchedLessons->add($lesson);
    }

    public function belongsTo(User $user): bool
    {
        return $this->user->getId() === $user->getId();
    }
}
