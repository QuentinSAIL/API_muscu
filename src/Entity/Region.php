<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getRegion'])]
    private ?int $id = null;

    #[Groups(['getRegion'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['getRegion'])]
    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Muscle::class)]
    private Collection $idmuscle;

    public function __construct()
    {
        $this->idmuscle = new ArrayCollection();
    }

     #[Groups(['getMuscle','getMuscleAll','createMuscle'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, muscle>
     */
    public function getIdmuscle(): Collection
    {
        return $this->idmuscle;
    }

    public function addIdmuscle(muscle $idmuscle): self
    {
        if (!$this->idmuscle->contains($idmuscle)) {
            $this->idmuscle->add($idmuscle);
            $idmuscle->setRegion($this);
        }

        return $this;
    }

    public function removeIdmuscle(muscle $idmuscle): self
    {
        if ($this->idmuscle->removeElement($idmuscle)) {
            // set the owning side to null (unless already changed)
            if ($idmuscle->getRegion() === $this) {
                $idmuscle->setRegion(null);
            }
        }

        return $this;
    }
}
