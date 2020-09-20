<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Profile
{
    public const CREATOR = 'creator';
    public const STUDENT = 'student';

    private string $id;
    private string $type;
    private User $user;
    private ?string $name;
    private ?string $lastName;
    private ?string $title;
    private ?string $bio;
    private ?string $website;
    private ?string $twitter;
    private ?string $facebook;
    private ?string $linkedin;
    private ?string $youtube;

    public function __construct(
        string $type,
        User $user,
        ?string $name,
        ?string $lastName,
        ?string $title,
        ?string $bio,
        ?string $website,
        ?string $twitter,
        ?string $facebook,
        ?string $linkedin,
        ?string $youtube
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->type = $type;
        $this->user = $user;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->title = $title;
        $this->bio = $bio;
        $this->website = $website;
        $this->twitter = $twitter;
        $this->facebook = $facebook;
        $this->linkedin = $linkedin;
        $this->youtube = $youtube;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): void
    {
        $this->bio = $bio;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): void
    {
        $this->website = $website;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): void
    {
        $this->twitter = $twitter;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): void
    {
        $this->linkedin = $linkedin;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): void
    {
        $this->youtube = $youtube;
    }

    public function belongsTo(User $user): bool
    {
        return $this->user->getId() === $user->getId();
    }
}
