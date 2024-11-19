<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\CreatedUpdatedTrait;
use App\Entity\Trait\StatusTrait;
use App\Enum\Presence;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: '`user`')]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $first_name = null;

    /**
     * @var Collection<int, UserDetail>
     */
    #[ORM\OneToMany(targetEntity: UserDetail::class, mappedBy: 'user_info')]
    private Collection $user_infos;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $last_name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(nullable: true, enumType: Presence::class)]
    private ?Presence $presence = null;

    use CreatedUpdatedTrait;
    use StatusTrait;

    public function __construct()
    {
        $this->user_infos = new ArrayCollection();
        $this->roles[] = 'ROLE_USER';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * @return Collection<int, UserDetail>
     */
    public function getUserInfos(): Collection
    {
        return $this->user_infos;
    }

    public function addUserInfo(UserDetail $userInfo): static
    {
        if (!$this->user_infos->contains($userInfo)) {
            $this->user_infos->add($userInfo);
            $userInfo->setUserInfo($this);
        }

        return $this;
    }

    public function removeUserInfo(UserDetail $userInfo): static
    {
        if ($this->user_infos->removeElement($userInfo)) {
            // set the owning side to null (unless already changed)
            if ($userInfo->getUserInfo() === $this) {
                $userInfo->setUserInfo(null);
            }
        }

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        // definir les rôles attribués aux utilisateur
        if (in_array($roles, ['ROLE_STUDENT', 'ROLE_TEACHER', 'ROLE_ADMIN', 'ROLE_USER'])) {
            $this->roles = $roles;
        }

        return $this;
    }

    public function getPresence(): ?Presence
    {
        return $this->presence;
    }

    public function setPresence(?Presence $presence): static
    {
        $this->presence = $presence;

        return $this;
    }
}
