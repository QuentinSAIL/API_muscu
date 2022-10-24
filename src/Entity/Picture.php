<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
/**
 * @Vich\Uploadable()
 */
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getPicture'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getPicture'])]
    private ?string $pictureName = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['getPicture'])]
    private ?string $pictureURL = null; // real_path

    #[ORM\Column(length: 255)]
    #[Groups(['getPicture'])]
    private ?string $public_path = null;

    #[ORM\Column(length: 50)]
    #[Groups(['getPicture'])]
    private ?string $mimeType = null;

    #[ORM\Column(length: 20)]
    #[Groups(['getPicture'])]
    private ?string $status = null;

    /**
     * @ar File|null
     * @Vich\UploadableField(mapping="pictures" fileNameProperty="picture_url")
     */
    private ?File $file;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPictureName(): ?string
    {
        return $this->pictureName;
    }

    public function setPictureName(string $pictureName): self
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    public function getPictureURL(): ?string
    {
        return $this->pictureURL;
    }

    public function setPictureURL(string $pictureURL): self
    {
        $this->pictureURL = $pictureURL;

        return $this;
    }

    public function getPublicPath(): ?string
    {
        return $this->public_path;
    }

    public function setPublicPath(string $public_path): self
    {
        $this->public_path = $public_path;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

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

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): ?Picture
    {
        $this->file = $file;
        return $this;
    }
}
