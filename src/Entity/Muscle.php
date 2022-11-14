<?php

namespace App\Entity;

use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MuscleRepository::class)]
class Muscle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getMuscle','getMuscleAll'])]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message : "un muscle doit avoir un nom")]
    #[Assert\NotNull()]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'met plus long, minimum : {{limit}}',
        maxMessage: 'met moins long, max : {{limit}}',
    )]
    #[Groups(['getMuscle','getMuscleAll','createMuscle'])]
    private ?string $muscleName = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(
        choices: ['on','off'],
        message: 'on on a dit',
    )]
    #[Groups(['getMuscle','getMuscleAll','createMuscle'])]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'RegionID')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $regionID = null;

    #[ORM\ManyToMany(targetEntity: Exercice::class, mappedBy: 'muscleID')]
    private Collection $exercices;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Picture $pictureID = null;

    #[ORM\OneToMany(mappedBy: 'muscleExercice', targetEntity: ExerciceMuscle::class)]
    private Collection $exerciceMuscles;

    #[ORM\ManyToMany(targetEntity: Exercice::class, mappedBy: 'idMuscle')]
    private Collection $exercice;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
        $this->exerciceMuscles = new ArrayCollection();
        $this->exercice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMuscleName(): ?string
    {
        return $this->muscleName;
    }

    public function setMuscleName(string $muscleName): self
    {
        $this->muscleName = $muscleName;

        return $this;
    }

    public function getRegionID(): ?Region
    {
        return $this->regionID;
    }

    public function setRegionID(?Region $regionID): self
    {
        $this->regionID = $regionID;

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
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): self
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
            $exercice->addMuscleID($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): self
    {
        if ($this->exercices->removeElement($exercice)) {
            $exercice->removeMuscleID($this);
        }

        return $this;
    }

    public function getPictureID(): ?Picture
    {
        return $this->pictureID;
    }

    public function setPictureID(?Picture $pictureID): self
    {
        $this->pictureID = $pictureID;

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
            $exerciceMuscle->setMuscleExercice($this);
        }

        return $this;
    }

    public function removeExerciceMuscle(ExerciceMuscle $exerciceMuscle): self
    {
        if ($this->exerciceMuscles->removeElement($exerciceMuscle)) {
            // set the owning side to null (unless already changed)
            if ($exerciceMuscle->getMuscleExercice() === $this) {
                $exerciceMuscle->setMuscleExercice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercice(): Collection
    {
        return $this->exercice;
    }
}
