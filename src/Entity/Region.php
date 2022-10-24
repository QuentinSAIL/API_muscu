<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use http\Message;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['createMuscle'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['createMuscle'])]
    private ?string $regionName = null;

    #[ORM\OneToMany(mappedBy: 'regionID', targetEntity: Muscle::class, orphanRemoval: true)]
    private Collection $RegionID;

    #[ORM\Column(length: 20)]
    #[Groups(['createMuscle'])]
    private ?string $status = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Picture $regionPicture = null;

    public function __construct()
    {
        $this->RegionID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    public function setRegionName(string $regionName): self
    {
        $this->regionName = $regionName;

        return $this;
    }

    /**
     * @return Collection<int, Muscle>
     */
    public function getRegionID(): Collection
    {
        return $this->RegionID;
    }

    public function addRegionID(Muscle $regionID): self
    {
        if (!$this->RegionID->contains($regionID)) {
            $this->RegionID->add($regionID);
            $regionID->setRegionID($this);
        }

        return $this;
    }

    public function removeRegionID(Muscle $regionID): self
    {
        if ($this->RegionID->removeElement($regionID)) {
            // set the owning side to null (unless already changed)
            if ($regionID->getRegionID() === $this) {
                $regionID->setRegionID(null);
            }
        }

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

    public function getRegionPicture(): ?Picture
    {
        return $this->regionPicture;
    }

    public function setRegionPicture(?Picture $regionPicture): self
    {
        $this->regionPicture = $regionPicture;

        return $this;
    }
}
