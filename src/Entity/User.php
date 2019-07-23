<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Vich\Uploadable
 */
class User implements UserInterface
{
    const AUTHORIZED_EXTENSIONS = ["image/jpg", "image/png", "image/jpeg"];
    const MAX_SIZE = '1024k';

    const STAND_BY = 'En attente';
    const ADMINISTRATOR = 'Administrateur';

    const ROLES = [
        self::ADMINISTRATOR => 'ROLE_ADMIN',
        'President' => 'ROLE_PRESIDENT',
        'President Trail' => 'ROLE_PRESIDENT',
        'President Triathlon' => 'ROLE_PRESIDENT',
        'Secrétaire' => 'ROLE_OFFICE',
        'Secrétaire adjoint(e)' => 'ROLE_OFFICE',
        'Trésorier(e)' => 'ROLE_OFFICE',
        'Trésorier(e) adjoint(e)' => 'ROLE_OFFICE',
        'Membre' => 'ROLE_MEMBER',
        'Membre d\'honneur' => 'ROLE_MEMBER',
        'Encadrant sportif' => 'ROLE_SPORTS',
        self::STAND_BY => 'ROLE_USER',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="L'email est obligatoire")
     * @Assert\Length(min="2", max="255", minMessage="l'email doit comporter {{ limit }} caractères",
     *     maxMessage="l'email doit comporter {{ limit }} caractères")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="le mot de passe est obligatoire !")
     * @Assert\Length(min="8", max="255", minMessage="le mot de passe doit comporter {{ limit }} caractères !",
     *      maxMessage="le mot de passe doit comporter {{ limit }} caractères !")
     */
    private $password;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire !")
     * @Assert\Length(max="255", maxMessage="votre prénom doit comporter au maximum {{ limit }} caractères")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire !")
     * @Assert\Length(max="255", maxMessage="votre Nom doit comporter au maximum {{ limit }} caractères !")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="vous devez indiquer votre adresse !")
     * @Assert\Length(min="2", max="255", minMessage="votre adresse doit comporter au minimum {{ limit }} caractères !",
     *    maxMessage="votre adresse doit comporter au maximum {{ limit }} caractères !" )
     */
    private $address;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Ce champ est obligatoire !")
     * @Assert\DateTime()
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire !")
     * @Assert\Length(min="10", max="255", minMessage="votre numéro doit composer au minimum {{ limit }} chiffres !",
     *     maxMessage="votre numéro doit composer au maximum {{ limit }} chiffres")
     */
    private $telephone;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Activity", mappedBy="users")
     * @Assert\NotBlank(message="vous devez indiquer une activité !")
     */
    private $activities;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gender", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Ce champ est obligatoire, pour les compétitions !")
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="user")
     */
    private $comments;

    /**
     * @Vich\UploadableField(mapping="image_member", fileNameProperty="imageName", size="imageSize")
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
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        if (is_null($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->addUser($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->contains($activity)) {
            $this->activities->removeElement($activity);
            $activity->removeUser($this);
        }

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

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

    public function getRolesDetails(): array
    {
        $rolesDetails = [];
        foreach ($this->getRoles() as $role) {
            foreach (array_keys(self::ROLES, $role) as $roleDetail) {
                $rolesDetails[] = $roleDetail;
            }
        }
        return $rolesDetails;
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
     * @return User
     */
    public function setImageSize(?int $imageSize): User
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
     * @return User
     */
    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): User
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
