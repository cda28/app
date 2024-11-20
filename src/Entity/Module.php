<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\StatusTrait;
use App\Entity\Trait\CreatedUpdatedTrait;
use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
#[ApiResource]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['show_module'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['show_module'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show_module'])]
    private ?string $repositoryLink = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $moduleOrder = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups(['show_module'])]
    private ?int $duration = null;

    /**
     * @var Collection<int, Course>
     */
    #[ORM\ManyToMany(targetEntity: Course::class, mappedBy: 'modules', cascade:['persist'])]
    private Collection $courses;

    #[ORM\Column(nullable: true)]
    private ?bool $is_updated = null;

    /**
     * @var Collection<int, UserModulePlanning>
     */
    #[ORM\OneToMany(targetEntity: UserModulePlanning::class, mappedBy: 'module')]
    private Collection $userModulePlannings;

    /**
     * @var Collection<int, Raiting>
     */
    #[ORM\OneToMany(targetEntity: Rating::class, mappedBy: 'module')]
    private Collection $ratings;

    use StatusTrait;
    use CreatedUpdatedTrait;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->userModulePlannings = new ArrayCollection();
        $this->ratings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getRepositoryLink(): ?string
    {
        return $this->repositoryLink;
    }

    public function setRepositoryLink(?string $repositoryLink): static
    {
        $this->repositoryLink = $repositoryLink;

        return $this;
    }

    public function getModuleOrder(): ?int
    {
        return $this->moduleOrder;
    }

    public function setModuleOrder(?int $moduleOrder): static
    {
        $this->moduleOrder = $moduleOrder;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): static
    {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
            $course->addModule($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): static
    {
        if ($this->courses->removeElement($course)) {
            $course->removeModule($this);
        }

        return $this;
    }

    public function isUpdated(): ?bool
    {
        return $this->is_updated;
    }

    public function setUpdated(?bool $is_updated): static
    {
        $this->is_updated = $is_updated;

        return $this;
    }

    /**
     * @return Collection<int, UserModulePlanning>
     */
    public function getUserModulePlannings(): Collection
    {
        return $this->userModulePlannings;
    }

    public function addUserModulePlanning(UserModulePlanning $userModulePlanning): static
    {
        if (!$this->userModulePlannings->contains($userModulePlanning)) {
            $this->userModulePlannings->add($userModulePlanning);
            $userModulePlanning->setModule($this);
        }

        return $this;
    }

    public function removeUserModulePlanning(UserModulePlanning $userModulePlanning): static
    {
        if ($this->userModulePlannings->removeElement($userModulePlanning)) {
            // set the owning side to null (unless already changed)
            if ($userModulePlanning->getModule() === $this) {
                $userModulePlanning->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): static
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
            $rating->setModule($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): static
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getModule() === $this) {
                $rating->setModule(null);
            }
        }

        return $this;
    }

}
