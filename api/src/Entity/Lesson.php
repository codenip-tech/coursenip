<?php

declare(strict_types=1);

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Lesson
{
    private string $id;
    private string $name;
    private string $slug;
    private string $videoProvider;
    private string $videoId;
    private string $description;
    private int $duration;
    private Course $course;
    private Collection $requirements;
    private Collection $results;

    public function __construct(
        string $name,
        string $videoProvider,
        string $videoId,
        string $description,
        int $duration,
        Course $course,
        array $requirements
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->slug = Slugify::create()->slugify($name);
        $this->videoProvider = $videoProvider;
        $this->videoId = $videoId;
        $this->description = $description;
        $this->duration = $duration;
        $this->course = $course;
        $this->requirements = new ArrayCollection($requirements);
        $this->results = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getVideoProvider(): string
    {
        return $this->videoProvider;
    }

    public function getVideoId(): string
    {
        return $this->videoId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getRequirements(): Collection
    {
        return $this->requirements;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getResults(): Collection
    {
        return $this->results;
    }
}
