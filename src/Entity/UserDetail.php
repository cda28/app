<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\CreatedUpdatedTrait;
use App\Entity\Trait\StatusTrait;
use App\Repository\UserDetailRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserDetailRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
class UserDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $cv = null;

    #[ORM\ManyToOne(inversedBy: 'user_infos')]
    private ?User $user_info = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $github_link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $personal_website = null;

    use CreatedUpdatedTrait;
    use StatusTrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getUserInfo(): ?User
    {
        return $this->user_info;
    }

    public function setUserInfo(?User $user_info): static
    {
        $this->user_info = $user_info;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getGithubLink(): ?string
    {
        return $this->github_link;
    }

    public function setGithubLink(?string $github_link): static
    {
        $this->github_link = $github_link;

        return $this;
    }

    public function getPersonalWebsite(): ?string
    {
        return $this->personal_website;
    }

    public function setPersonalWebsite(?string $personal_website): static
    {
        $this->personal_website = $personal_website;

        return $this;
    }
}
