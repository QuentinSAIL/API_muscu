<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getExercice'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getExercice'])]
    private ?string $exerciceName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['getExercice'])]
    private ?string $exerciceDescription = null;

    #[ORM\Column(length: 20)]
    #[Groups(['getExercice'])]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getExercice'])]
    private ?string $exercicePicture = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['getExercice'])]
    private ?string $exerciceURL = null;

    #[ORM\ManyToMany(targetEntity: Muscle::class, inversedBy: 'exercices')]
    private Collection $muscleID;

    #[ORM\OneToMany(mappedBy: 'idExercice', targetEntity: ExerciceMuscle::class)]
    private Collection $exerciceMuscles;

    #[ORM\ManyToMany(targetEntity: muscle::class, inversedBy: 'exercice')]
    private Collection $idMuscle;

    #[ORM\ManyToMany(targetEntity: muscle::class)]
    private Collection $MuscleID;

    public function __construct()
    {
        $this->muscleID = new ArrayCollection();
        $this->exerciceMuscles = new ArrayCollection();
        $this->idMuscle = new ArrayCollection();
        $this->MuscleID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExerciceName(): ?string
    {
        return $this->exerciceName;
    }

    public function setExerciceName(string $exerciceName): self
    {
        $this->exerciceName = $exerciceName;

        return $this;
    }

    public function getExerciceDescription(): ?string
    {
        return $this->exerciceDescription;
    }

    public function setExerciceDescription(?string $exerciceDescription): self
    {
        $this->exerciceDescription = $exerciceDescription;

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

    public function getExercicePicture(): ?string
    {
        return $this->exercicePicture;
    }

    public function setExercicePicture(string $exercicePicture): self
    {
        $this->exercicePicture = $exercicePicture;

        return $this;
    }

    public function getExerciceURL(): ?string
    {
        return $this->exerciceURL;
    }

    public function setExerciceURL(?string $exerciceURL): self
    {
        $this->exerciceURL = $exerciceURL;

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
     * @return Collection<int, ExerciceMuscle>
     */
    public function getExerciceMuscles(): Collection
    {
        return $this->exerciceMuscles;
    }

    public function addExerciceMuscle(ExerciceMuscle $exerciceMuscle): self
    {
        if (!$this->exerciceMuscles->contains($exerciceMuscle)) {
            $this->exerciceMuscles->add($exerciceMuscle);
            $exerciceMuscle->setIdExercice($this);
        }

        return $this;
    }

    public function removeExerciceMuscle(ExerciceMuscle $exerciceMuscle): self
    {
        if ($this->exerciceMuscles->removeElement($exerciceMuscle)) {
            // set the owning side to null (unless already changed)
            if ($exerciceMuscle->getIdExercice() === $this) {
                $exerciceMuscle->setIdExercice(null);
            }
        }

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
