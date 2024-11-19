<?php

namespace App\Entity;

use App\Enum\Confirmed;
use App\Repository\UserModulePlanningRepository;
use App\Entity\Trait\CreatedUpdatedTrait;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\StatusTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserModulePlanningRepository::class)]
#[ApiResource]
class UserModulePlanning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userModulePlannings')]
    private ?Module $module = null;

    #[ORM\ManyToOne(inversedBy: 'userModulePlannings')]
    private ?User $userModule= null;

    #[ORM\Column(nullable: true, enumType: Confirmed::class)]
    private ?Confirmed $confirmed = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    use StatusTrait;
    use CreatedUpdatedTrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): static
    {
        $this->module = $module;

        return $this;
    }

    public function getUserModule(): ?User
    {
        return $this->userModule;
    }

    public function setUserModule(?User $userModule): static
    {
        $this->userModule = $userModule;

        return $this;
    }

    public function getConfirmed(): ?Confirmed
    {
        return $this->confirmed;
    }

    public function setConfirmed(?Confirmed $confirmed): static
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

}
