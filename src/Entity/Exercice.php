<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MuscleRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getMuscle','getExercice'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getMuscle','getExercice'])]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Muscle::class, inversedBy: 'exercices')]
    private Collection $idMuscle;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

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
        return $this->idMuscle;
    }

    public function addMuscleID(Muscle $muscleID): self
    {
        if (!$this->idMuscle->contains($muscleID)) {
            $this->idMuscle->add($muscleID);
        }

        return $this;
    }

    public function removeMuscleID(Muscle $muscleID): self
    {
        $this->idMuscle->removeElement($muscleID);

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
