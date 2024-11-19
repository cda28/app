<?php 

namespace App\Entity\Trait ;

use App\Enum\Status;
use Doctrine\ORM\Mapping as ORM;

trait StatusTrait{

    #[ORM\Column(nullable: true, enumType: Status::class)]
    private ?Status $status = null;

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }
   
}