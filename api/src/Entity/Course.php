<?php

declare(strict_types=1);

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Course
{
    private string $id;
    private string $imagePath;
    private string $name;
    private string $slug;
    private string $description;
    private int $duration;
    private int $score;
    private \DateTime $createDate;
    private \DateTime $updateDate;
    private User $creator;
    private Collection $requirements;
    private Collection $results;

    public function __construct(
        string $imagePath,
        string $name,
        string $description,
        int $duration,
        User $creator,
        array $requirements
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->imagePath = $imagePath;
        $this->name = $name;
        $this->slug = Slugify::create()->slugify($name);
        $this->description = $description;
        $this->duration = $duration;
        $this->score = 0;
        $this->createDate = new \DateTime();
        $this->markAsUpdated();
        $this->creator = $creator;
        $this->requirements = new ArrayCollection($requirements);
        $this->results = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    public function markAsUpdated(): void
    {
        $this->updateDate = new \DateTime();
    }

    public function getCreator(): User
    {
        return $this->creator;
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
