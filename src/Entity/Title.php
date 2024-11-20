<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\Trait\StatusTrait;
use App\Entity\Trait\CreatedUpdatedTrait;
use App\Repository\TitleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TitleRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource]
class Title
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['show_title'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Education>
     */
    #[ORM\ManyToMany(targetEntity: Education::class, inversedBy: 'titles')]
    private Collection $educations;

    use StatusTrait;
    use CreatedUpdatedTrait;

    public function __construct()
    {
        $this->educations = new ArrayCollection();
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

}
