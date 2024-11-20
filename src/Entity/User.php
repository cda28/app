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
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: '`user`')]
#[ApiResource]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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

    /**
     * @var Collection<int, Degree>
     */
    #[ORM\ManyToMany(targetEntity: Degree::class, inversedBy: 'users')]
    private Collection $dregrees;

    /**
     * @var Collection<int, Rating>
     */
    #[ORM\OneToMany(targetEntity: Rating::class, mappedBy: 'user_rating')]
    private Collection $user_ratings;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $address = null;

    /**
     * @var Collection<int, Education>
     */
    #[ORM\ManyToMany(targetEntity: Education::class, inversedBy: 'users')]
    private Collection $educations;

    use CreatedUpdatedTrait;
    use StatusTrait;

    public function __construct()
    {
        $this->user_infos = new ArrayCollection();
        $this->roles[] = 'ROLE_USER';
        $this->dregrees = new ArrayCollection();
        $this->user_ratings = new ArrayCollection();
        $this->educations = new ArrayCollection();
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
        // definir les rôles attribués aux utilisateurs
        if(empty(array_diff($roles, ['ROLE_STUDENT', 'ROLE_TEACHER', 'ROLE_ADMIN', 'ROLE_USER']))){
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

    /**
     * @return Collection<int, Degree>
     */
    public function getDregrees(): Collection
    {
        return $this->dregrees;
    }

    public function addDregree(Degree $dregree): static
    {
        if (!$this->dregrees->contains($dregree)) {
            $this->dregrees->add($dregree);
        }

        return $this;
    }

    public function removeDregree(Degree $dregree): static
    {
        $this->dregrees->removeElement($dregree);

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getUserRatings(): Collection
    {
        return $this->user_ratings;
    }

    public function addUserRating(Rating $userRating): static
    {
        if (!$this->user_ratings->contains($userRating)) {
            $this->user_ratings->add($userRating);
            $userRating->setUserRating($this);
        }

        return $this;
    }

    public function removeUserRating(Rating $userRating): static
    {
        if ($this->user_ratings->removeElement($userRating)) {
            // set the owning side to null (unless already changed)
            if ($userRating->getUserRating() === $this) {
                $userRating->setUserRating(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Education>
     */
    public function getEducations(): Collection
    {
        return $this->educations;
    }

    public function addEducation(Education $education): static
    {
        if (!$this->educations->contains($education)) {
            $this->educations->add($education);
        }

        return $this;
    }

    public function removeEducation(Education $education): static
    {
        $this->educations->removeElement($education);

        return $this;
    }


    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

}
