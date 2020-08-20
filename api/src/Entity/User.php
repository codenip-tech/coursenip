<?php

declare(strict_types=1);

namespace App\Entity;

use App\Value\Email;
use App\Value\NonEmptyString;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

class User implements UserInterface
{
    private string $id;
    private string $name;
    private ?string $slug;
    private string $email;
    private ?string $password;
    private ?string $avatar;
    private ?string $token;
    private ?string $resetPasswordToken;
    private bool $active;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;
    private ?\DateTime $lastLogin;

    public function __construct(NonEmptyString $name, Email $email)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->setName($name);
        $this->setEmail($email);
        $this->password = null;
        $this->avatar = null;
        $this->token = \sha1(\uniqid());
        $this->resetPasswordToken = null;
        $this->active = false;
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): NonEmptyString
    {
        return new NonEmptyString($this->name);
    }

    public function setName(NonEmptyString $name): void
    {
        $this->name = $name->getValue();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function getEmail(): Email
    {
        return new Email($this->email);
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email->getValue();
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function getResetPasswordToken(): ?string
    {
        return $this->resetPasswordToken;
    }

    public function setResetPasswordToken(?string $resetPasswordToken): void
    {
        $this->resetPasswordToken = $resetPasswordToken;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }

    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTime $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getSalt(): void
    {
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
    }
}
