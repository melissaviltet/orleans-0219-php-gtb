<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    private $id;

    /**
     * @var string|null
     * @Assert\Length(min="2",max="100", minMessage="Veuillez saisir un Nom valide",
     *     maxMessage="Veuillez saisir un Nom valide")
     * @Assert\NotBlank(message="Veuillez saisir un Nom valide")
     */

    private $lastname;

    /**
     * @var string|null
     * @Assert\Length(min="2",max="100", minMessage="Veuillez saisir un Prénom valide",
     *     maxMessage="Veuillez saisir un Prénom valide")
     * @Assert\NotBlank(message="Veuillez saisir un Prénom valide")
     *
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Veuillez saisir une adresse email valide.")
     * @Assert\Email(message = "Veuillez saisir une adresse email valide.")
     */
    private $email;


    private $subject;

    /**
     * @var string|null
     * @Assert\Length(min="5",max="10000", maxMessage="votre message ne peux pas dépasser 10000 caractères")
     * @Assert\NotBlank(message="Veuillez saisir votre message avant l'envoi")
     *
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
