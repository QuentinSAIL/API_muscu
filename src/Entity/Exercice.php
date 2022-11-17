<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MuscleRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getMuscle'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getMuscle'])]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Muscle::class, inversedBy: 'exercices')]
    #[Groups(['getMuscle'])]
    private Collection $idMuscle;

    public function __construct()
    {
        $this->idMuscle = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, muscle>
     */
    public function getIdMuscle(): Collection
    {
        return $this->idMuscle;
    }

    public function addIdMuscle(muscle $idMuscle): self
    {
        if (!$this->idMuscle->contains($idMuscle)) {
            $this->idMuscle->add($idMuscle);
        }

        return $this;
    }

    public function removeIdMuscle(muscle $idMuscle): self
    {
        $this->idMuscle->removeElement($idMuscle);

        return $this;
    }
}
