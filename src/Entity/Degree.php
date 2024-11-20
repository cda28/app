<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Trait\CreatedUpdatedTrait;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\DegreeRepository;
use App\Entity\Trait\StatusTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\Diploma;

#[ORM\Entity(repositoryClass: DegreeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
class Degree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true, enumType: Diploma::class)]
    private ?Diploma $diploma = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $speciality = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $obtained_at = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'dregrees')]
    private Collection $users;

    use StatusTrait;
    use CreatedUpdatedTrait;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDiploma(): ?Diploma
    {
        return $this->diploma;
    }

    public function setDiploma(?Diploma $diploma): static
    {
        $this->diploma = $diploma;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): static
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getObtainedAt(): ?\DateTimeImmutable
    {
        return $this->obtained_at;
    }

    public function setObtainedAt(?\DateTimeImmutable $obtained_at): static
    {
        $this->obtained_at = $obtained_at;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addDregree($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeDregree($this);
        }

        return $this;
    }

}
