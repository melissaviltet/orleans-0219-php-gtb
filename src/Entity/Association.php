<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRepository")
 */
class Association
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $trailContent;

    /**
     * @ORM\Column(type="text")
     */
    private $trailHome;

    /**
     * @ORM\Column(type="text")
     */
    private $triaContent;

    /**
     * @ORM\Column(type="text")
     */
    private $triaHome;

    /**
     * @ORM\Column(type="text")
     */
    private $clubContent;

    /**
     * @ORM\Column(type="text")
     */
    private $clubHome;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrailContent(): ?string
    {
        return $this->trailContent;
    }

    public function setTrailContent(string $trailContent): self
    {
        $this->trailContent = $trailContent;

        return $this;
    }

    public function getTrailHome(): ?string
    {
        return $this->trailHome;
    }

    public function setTrailHome(string $trailHome): self
    {
        $this->trailHome = $trailHome;

        return $this;
    }

    public function getTriaContent(): ?string
    {
        return $this->triaContent;
    }

    public function setTriaContent(string $triaContent): self
    {
        $this->triaContent = $triaContent;

        return $this;
    }

    public function getTriaHome(): ?string
    {
        return $this->triaHome;
    }

    public function setTriaHome(string $triaHome): self
    {
        $this->triaHome = $triaHome;

        return $this;
    }

    public function getClubContent(): ?string
    {
        return $this->clubContent;
    }

    public function setClubContent(string $clubContent): self
    {
        $this->clubContent = $clubContent;

        return $this;
    }

    public function getClubHome(): ?string
    {
        return $this->clubHome;
    }

    public function setClubHome(string $clubHome): self
    {
        $this->clubHome = $clubHome;

        return $this;
    }
}
