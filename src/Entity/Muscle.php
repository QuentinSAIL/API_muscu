<?php

namespace App\Entity;

use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
        message: '"on" on a dit',
    )]
    #[Groups(['getMuscle','getMuscleAll','createMuscle'])]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'idmuscle')]
    private ?Region $regionId = null;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getRegionId(): ?Region
    {
        return $this->regionId;
    }

    public function setRegionId(?Region $regionId): self
    {
        $this->regionId = $regionId;

        return $this;
    }


}
