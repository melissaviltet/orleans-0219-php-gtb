<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @Vich\Uploadable
 */
class Event
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
     * @ORM\Column(type="string", length=255)
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
     * @Vich\UploadableField(mapping="image_event", fileNameProperty="imageName", size="imageSize")
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
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlEvent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPrivate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text")
     */
    private $longDescription;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="event")
     */
    private $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlEvent()
    {
        return $this->urlEvent;
    }

    /**
     * @param mixed $urlEvent
     * @return Event
     */
    public function setUrlEvent($urlEvent)
    {
        $this->urlEvent = $urlEvent;
        return $this;
    }

    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvent($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getEvent() === $this) {
                $comment->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param mixed $shortDescription
     * @return Event
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * @param mixed $longDescription
     * @return Event
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;
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
     * @return Event
     */
    public function setImageSize(?int $imageSize): Event
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
     * @return Event
     */
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): Event
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
