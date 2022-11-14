<?php

namespace App\Entity;

use App\Repository\ExerciceMuscleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceMuscleRepository::class)]
class   ExerciceMuscle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'exerciceMuscles')]
    private ?exercice $idExercice = null;

    #[ORM\ManyToOne(inversedBy: 'exerciceMuscles')]
    private ?muscle $muscleExercice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdExercice(): ?exercice
    {
        return $this->idExercice;
    }

    public function setIdExercice(?exercice $idExercice): self
    {
        $this->idExercice = $idExercice;

        return $this;
    }

    public function getMuscleExercice(): ?muscle
    {
        return $this->muscleExercice;
    }

    public function setMuscleExercice(?muscle $muscleExercice): self
    {
        $this->muscleExercice = $muscleExercice;

        return $this;
    }
}
