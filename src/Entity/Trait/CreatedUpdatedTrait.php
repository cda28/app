<?php 

namespace App\Entity\Trait ;

use Doctrine\ORM\Mapping as ORM;

trait CreatedUpdatedTrait{

    #[ORM\Column(type: "datetime", nullable: true)]
    protected \DateTime $createdAt;

    #[ORM\Column(type: "datetime", nullable: true)]
    protected \DateTime $updatedAt;

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    #[ORM\PrePersist]
    public function setCreationDate(): void
    {
       $this->createdAt = new \DateTime();
    }
 
    #[ORM\PreUpdate]
    public function updateTimestamp(): void
    {
       $this->updatedAt = new \DateTime();
    }
}