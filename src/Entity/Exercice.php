<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MuscleRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

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

    /**
     * @return Collection<int, Muscle>
     */
    public function getMuscleID(): Collection
    {
        return $this->muscleID;
    }

    public function addMuscleID(Muscle $muscleID): self
    {
        if (!$this->muscleID->contains($muscleID)) {
            $this->muscleID->add($muscleID);
        }

        return $this;
    }

    public function removeMuscleID(Muscle $muscleID): self
    {
        $this->muscleID->removeElement($muscleID);

        return $this;
    }


}
