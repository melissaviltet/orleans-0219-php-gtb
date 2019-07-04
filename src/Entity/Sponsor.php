<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SponsorRepository")
 * @Vich\Uploadable
 * @UniqueEntity(
 *     fields={"name"},
 *     message="Ce partenaire existe déjà"
 * )
 */
class Sponsor
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
     * @Vich\UploadableField(mapping="image_sponsor", fileNameProperty="imageName", size="imageSize")
     * @Assert\NotBlank(message="Champs requis")
     * @Assert\File(
     *     maxSize=Sponsor::MAX_SIZE,
     *     maxSizeMessage="Image trop lourde!",
     *     mimeTypes=Sponsor::AUTHORIZED_EXTENSIONS,
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Champs requis")
     * @Assert\Length(
     *     min = 2,
     *     max = 255,
     *     minMessage = "Doit avoir au moins {{ limit }} caractères",
     *     maxMessage = "Ne doit pas depasser les {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champs requis")
     * @Assert\Length(
     *     min = 2,
     *     max = 255,
     *     minMessage = "Doit avoir au moins {{ limit }} caractères",
     *     maxMessage = "Ne doit pas depasser les {{ limit }} caractères"
     * )
     */
    private $site;

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

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(string $site): self
    {
        $this->site = $site;

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
     * @return Sponsor
     */
    public function setImageSize(?int $imageSize): Sponsor
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
     * @return Sponsor
     */
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): Sponsor
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
