<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GaleryRepository")
 * @Vich\Uploadable
 * @UniqueEntity(
 *     fields={"alt"},
 *     message="Ce image existe déjà"
 * )
 */
class Galery
{
    const AUTHORIZED_EXTENSIONS = ["image/jpg", "image/png", "image/jpeg"];
    const MAX_SIZE = '1024k';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Champs requis")
     * @Assert\Length(
     *     min = 2,
     *     max = 255,
     *     minMessage = "Doit avoir au moins {{ limit }} caractères",
     *     maxMessage = "Ne doit pas depasser les {{ limit }} caractères"
     * )
     */
    private $alt;

    /**
     * @Vich\UploadableField(mapping="image_gallery", fileNameProperty="imageName", size="imageSize")
     * @Assert\NotBlank(message="Champs requis")
     * @Assert\File(
     *     maxSize=Galery::MAX_SIZE,
     *     maxSizeMessage="Image trop lourde!",
     *     mimeTypes=Galery::AUTHORIZED_EXTENSIONS,
     *     mimeTypesMessage="Extension de fichier non autorisée",
     * )
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     * @Assert\Length(
     *     min = 2,
     *     max = 255,
     *     minMessage = "Doit avoir au moins {{ limit }} caractères",
     *     maxMessage = "Ne doit pas depasser les {{ limit }} caractères"
     * )
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var integer|null
     */
    private $imageSize;

    /**
     * @ORM\Column(type="date_immutable", nullable=true)
     * @var \DateTimeImmutable|null
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $private;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getPrivate(): ?bool
    {
        return $this->private;
    }

    public function setPrivate(bool $private): self
    {
        $this->private = $private;

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->setUpdatedAt(new \DateTimeImmutable());
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @return int|null
     */
    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    /**
     * @param int|null $imageSize
     * @return Galery
     */
    public function setImageSize(?int $imageSize): Galery
    {
        $this->imageSize = $imageSize;
        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable|null $updatedAt
     * @return Galery
     */
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): Galery
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
